# Unprefix BEM Scope Library


## What is BEM

BEM — Block Element Modifier is a methodology that helps you to create reusable components and code sharing in front-end development.

<dl>
	<dt>Block</dt>
	<dd>Encapsulates a standalone entity that is meaningful on its own. While blocks can be nested and interact with each other, semantically they remain equal; there is no precedence or hierarchy. Holistic entities without DOM representation (such as controllers or models) can be blocks as well.</dd>
	<dt>Element</dt>
	<dd>Parts of a block and have no standalone meaning. Any element is semantically tied to its block.</dd>
	<dt>Modifier</dt>
	<dd>Flags on blocks or elements. Use them to change appearance, behavior or state.</dd>
</dl>

Example

```
.block__element {}

.block block--modifier {}
```

For more information have a look at: [getbem](http://getbem.com/)

## How to use it

To use the bem scope you must create a instance of the `BemScopePrefixed` then it's possible to retrieve
the `scope` string or if you want every single part of the `BEM`.

It is possible to pass a `prefix` to the constructor to prevent collisions with other classes.

The `BemScopePrefixed` class implements the magic method `__toString` so it's possible to get the scope
directly from the instance.

```
// Create an instance of the class.
$bem = new \Unprefix\Bem\BemPrefixed();