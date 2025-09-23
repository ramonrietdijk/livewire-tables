# Versioning

This package follows the [Semantic Versioning](https://semver.org) scheme.

## Exceptions

There are a few exceptions to the backwards compatibility promise that this package provides.

### Named arguments

The use of [named arguments](https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments) is not backed. Function arguments may be renamed between releases to improve the codebase.

### Partially published views

The views within this package may change in content and structure over time. Publishing all views will not cause issues and breaking changes will always be documented in the upgrade guide.

Partially published views may cause problems and is not backed by the backwards compatibility promise.
