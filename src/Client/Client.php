<?php

declare(strict_types=1);

namespace FactorioItemBrowser\Api\Client\Client;

use BluePsyduck\Common\Data\DataContainer;
use BluePsyduck\MultiCurl\Constant\RequestMethod;
use BluePsyduck\MultiCurl\Entity\Request;
use BluePsyduck\MultiCurl\MultiCurlManager;
use FactorioItemBrowser\Api\Client\Entity\Meta;
use FactorioItemBrowser\Api\Client\Exception\ApiClientException;
use FactorioItemBrowser\Api\Client\Exception\ExceptionFactory;
use FactorioItemBrowser\Api\Client\Request\Auth\AuthRequest;
use FactorioItemBrowser\Api\Client\Request\RequestInterface;
use FactorioItemBrowser\Api\Client\Response\AbstractResponse;
use FactorioItemBrowser\Api\Client\Response\Auth\AuthResponse;
use FactorioItemBrowser\Api\Client\Response\PendingResponse;

/**
 * The client actually sending the requests to the API server.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Client
{
    /**
     * The options of the client.
     * @var Options
     */
    protected $options;

    /**
     * The multi cUrl manager.
     * @var MultiCurlManager
     */
    protected $multiCurlManager;

    /**
     * The locale to use for the requests.
     * @var string
     */
    protected $locale = 'en';

    /**
     * The names of the mods to be enabled.
     * @var array|string[]
     */
    protected $enabledModNames = [];

    /**
     * The authorization token to use, if already available.
     * @var string
     */
    protected $authorizationToken = '';

    /**
     * Initializes the client.
     * @param Options $options
     * @param MultiCurlManager|null $multiCurlManager
     */
    public function __construct(Options $options, MultiCurlManager $multiCurlManager = null)
    {
        $this->options = $options;
        if ($multiCurlManager instanceof MultiCurlManager) {
            $this->multiCurlManager = $multiCurlManager;
        } else {
            $this->multiCurlManager = new MultiCurlManager();
        }
    }

    /**
     * Sets the locale to use for the requests.
     * @param string $locale
     * @return $this Implementing fluent interface.
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Sets the names of the mods to be enabled.
     * @param array|string[] $enabledModNames
     * @return $this Implementing fluent interface.
     */
    public function setEnabledModNames(array $enabledModNames)
    {
        $this->enabledModNames = $enabledModNames;
        return $this;
    }

    /**
     * Sets the authorization token to use, if already available.
     * @param string $authorizationToken
     * @return $this Implementing fluent interface.
     */
    public function setAuthorizationToken(string $authorizationToken)
    {
        $this->authorizationToken = $authorizationToken;
        return $this;
    }

    /**
     * Returns the the authorization token to use, if already available.
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }

    /**
     * Sends the specified request to the API server.
     * @param RequestInterface $request
     * @return AbstractResponse
     * @throws ApiClientException
     */
    public function send(RequestInterface $request): AbstractResponse
    {
        if (strlen($this->authorizationToken) === 0 && !$request instanceof AuthRequest) {
            $this->requestAuthorizationToken();
        }

        $clientRequest = $this->createRequest($request->getRequestPath(), $request->getRequestData());
        $this->executeRequest($clientRequest);
        $pendingResponse = new PendingResponse($this, $clientRequest);
        return $request->createResponse($pendingResponse);
    }

    /**
     * Creates the request to be executed.
     * @param string $requestPath
     * @param array $requestData
     * @return Request
     */
    protected function createRequest(string $requestPath, array $requestData): Request
    {
        $request = new Request();
        $request
            ->setMethod(RequestMethod::POST)
            ->setUrl(rtrim($this->options->getApiUrl(), '/') . $requestPath);

        $request->getHeader()
            ->set('Content-Type', 'application/json')
            ->set('Accept-Language', $this->locale);

        if ($this->options->getTimeout() > 0) {
            $request->setTimeout($this->options->getTimeout());
        }
        if (count($requestData) > 0) {
            $request->setRequestData(json_encode($requestData));
        }
        return $request;
    }

    /**
     * Executes the request.
     * @param Request $request
     * @return Client
     */
    public function executeRequest(Request $request)
    {
        if (strlen($this->authorizationToken) > 0) {
            $request->getHeader()->set('Authorization', 'Bearer ' . $this->authorizationToken);
        }

        $this->multiCurlManager->addRequest($request);
        return $this;
    }

    /**
     * Fetches the response to the specified request.
     * @param Request $request
     * @return array
     * @throws ApiClientException
     */
    public function fetchResponse(Request $request): array
    {
        $this->multiCurlManager->waitForSingleRequest($request);
        $response = $request->getResponse();
        if ($response->getErrorCode() === CURLE_OPERATION_TIMEDOUT) {
            throw ExceptionFactory::create(408, '', $request->getRequestData(), '');
        } elseif ($response->getErrorCode() !== CURLE_OK) {
            throw ExceptionFactory::create(
                0,
                'Request failed: ' . $response->getErrorMessage(),
                $request->getRequestData(),
                $response->getContent()
            );
        }

        $decodedResponse = json_decode($request->getResponse()->getContent(), true);
        if (!is_array($decodedResponse)) {
            throw ExceptionFactory::create(
                0,
                'Response was not a valid JSON string.',
                $request->getRequestData(),
                $response->getContent()
            );
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
            $meta = (new Meta())->readData((new DataContainer($decodedResponse))->getObject('meta'));
            throw ExceptionFactory::create(
                $response->getStatusCode(),
                $meta->getErrorMessage(),
                $request->getRequestData(),
                $response->getContent()
            );
        }

        return $decodedResponse;
    }

    /**
     * Requests a new authorization token from the API server.
     * @return $this
     * @throws ApiClientException
     */
    public function requestAuthorizationToken()
    {
        $request = new AuthRequest();
        $request->setAgent($this->options->getAgent())
                ->setAccessKey($this->options->getAccessKey())
                ->setEnabledModNames($this->enabledModNames);

        /* @var AuthResponse $response */
        $response = $this->send($request);
        $this->authorizationToken = $response->getAuthorizationToken();
        return $this;
    }
}