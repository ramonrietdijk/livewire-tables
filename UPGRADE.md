# Upgrade Guide

Guide to upgrade the package to the next major versions.

## Upgrading to 2.x from 1.x

In version 2.x of this package the dependency of `blade-ui-kit/blade-heroicons` has been dropped. All icons are now displayed using the SVG directly. If you have published the views of this package you should either update all icons to SVG instead of the blade component or install `blade-ui-kit/blade-heroicons` again manually.
