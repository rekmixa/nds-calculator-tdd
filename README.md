# Пример реализации класса NdsCalculator с применением подхода TDD

## Install

```bash
make install
```

## Setup

```bash
make
```

## Composer

```bash
make composer-install
```

## Running tests

```bash
make env
vendor/bin/phpunit tests
```

## Running mutation tests

```bash
make env
vendor/bin/infection --threads=4
```
