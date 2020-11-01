# Changelog

## 3.2.0 - 2020-11-01

### Added

- New `/combination/validate` request.

## 3.1.0 - 2020-05-02

### Added

- New `/item/list` and `recipe/list` requests.

## 3.0.0 - 2020-04-15

### Added

- New `/combination/status` and `/combination/export` requests.

### Changed

- `enabledModNames` to `modNames` in the `/auth` request and the client itself.
- Version of `jms/serializer` to 3.2 or newer. 

### Removed

- No longer required `agent` from the `/auth` request and the client itself.
- No longer supported `/mod/meta` request.
- No longer supported `isEnabled` flag from the `Mod` entity.

## 2.1.0 - 2019-07-15

### Added

- Attribute `size` to the generic icon response.

## 2.0.0 - 2019-04-07

### Added

- Configuration for Zend Expressive projects.

### Changed

- Refactored the whole client to use JMS serializer and the Guzzle HTTP client.
- The API client now resolves the pending responses instead of the response classes. See README example for new usage.

## 1.1.0 - 2018-07-21

### Added

- `Machine` entity.
- `/recipe/machines` request and response.

### Changed

- Expensive recipes are now returned attached to their normal version instead of a separate recipe. 
  This changes the responses of `/item/ingredient`, `/item/product`, `/item/random`, `/recipe/details` and 
  `/search/query` requests. 

### Removed

- `Meta` entity from all responses.

## 1.0.1 - 2018-04-14

### Added

- Added missing search query request.

### Changed

- Classes `Item`, `Recipe` and `Mod` now extend the `GenericEntity`.

### Removed

- `TranslatedEntityInterface`, now covered by the `GenericEntity` class itself.

## 1.0.0 - 2018-04-05

- Initial release of the API client.
