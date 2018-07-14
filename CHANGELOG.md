# Changelog

## Unreleased

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