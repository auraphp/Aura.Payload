# CHANGELOG

## 3.1.0 (unreleased)

Housekeeping release; no changes to the library itself.

- Continuous integration now runs the test suite on every supported PHP
  version, 5.6 through 8.5, resolving the newest PHPUnit each one can take
  (5.7 on PHP 5.6, up to 12.x on PHP 8.3+).

- The tests extend `Yoast\PHPUnitPolyfills\TestCases\TestCase` rather than
  PHPUnit's own `TestCase`, which is what makes that spread of PHPUnit
  versions possible from a single test suite.

- Code coverage moved to a job of its own. It had been asked for on every
  matrix job with no filter configured, so PHPUnit processed no coverage at
  all and the upload found nothing to send.

- `composer.json` now requires `^5.6 || ^7.0 || ^8.0`. The lower bound was
  `^5.5`, a version that has been end of life since 2016 and that CI cannot
  install, so nothing was ever verified against it.

- The README now states the PHP versions actually supported, and carries the
  GitHub Actions badge in place of the retired Travis CI one.

Replaces `CHANGES.md`, which recorded only the most recent release. The
entries below are reconstructed from the release tags.

## [3.0.1](https://github.com/auraphp/Aura.Payload/releases/tag/3.0.1) (2016-10-03)

Hygiene release: documentation fixes.

## [3.0.0](https://github.com/auraphp/Aura.Payload/releases/tag/3.0.0) (2015-12-01)

First stable release.

## [3.0.0-beta1](https://github.com/auraphp/Aura.Payload/releases/tag/3.0.0-beta1) (2015-11-10)

This release removes the status codes implementation in favor of the
interface-provided `PayloadStatus` class, and adds a `PayloadFactory` class.

## [3.0.0-alpha1](https://github.com/auraphp/Aura.Payload/releases/tag/3.0.0-alpha1) (2015-05-18)

First 3.x alpha release.
