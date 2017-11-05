# LING means Legacy Is Not Good

[![Build Status](https://travis-ci.org/ling-framework/common.svg?branch=master)](https://travis-ci.org/ling-framework/common)

Ling is a minimalistic PHP MVC framework, carefully designed not to make a legacy issue. Inspired by Wordpress, Laravel and usa-framework.

One day I noticed that most of developer's daily work is not development.
There are too many unnecessary things to do. i.e. maintain previous work.

## Why legacy matters

1. You don't want to waste your time in seting-up another fancy next generation framework.
1. You don't want to maintain old and insecure framework.
1. You want to adopt some coolest features or latest security patches without conflicting.
1. You want to focus on the business logic, running app, making money.

## How can we achieve legacy-free

1. All parts of framework must be separated and independent modules(Except config and hook).
1. All future codes must support previous APIs.
1. If there needs some breaking changes in some module, make another module and migrate to it.
1. Allow separate modules at the sametime for convenient migration, even core module can be migrated and replaced.

## We need these policy for legacy-free

1. Use modern PHP's best practices, include FP.
1. Prefer native features always.
1. Use composer for making all modules pluggable.
1. Use hook for separating each modules.

## There are some more goals to solve legacy issue

1. IDE-centric Development. Don't use reflection and DI. Those complicate dependencies.
1. Use code generator for separating environment to actual code.
1. Complete documents and sample sites.

This framework is consist of 8 parts. 

1. common
1. router
1. form
1. orm (mysql, sqlite3)
1. view
1. exception
1. log
1. auth
1. theme

It can cover many web services, but it doesn't aim full-featured all-in-one framework. If you want all-in-one, I recommend Laravel.
