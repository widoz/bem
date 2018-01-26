[![Build Status](https://travis-ci.org/widoz/bem.svg?branch=master)](https://travis-ci.org/widoz/bem)

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

## How it works

To use the bem scope you must create a instance of the `BemScopePrefixed` then it's possible to retrieve
the `scope` string or if you want every single part of the `BEM`.

It is possible to pass a `prefix` to the constructor to prevent collisions with other classes.

The `BemScopePrefixed` class implements the magic method `__toString` so it's possible to get the scope
directly from the instance.

```php
// Create an instance of the class.
$bem = new \Unprefix\Bem\BemPrefixed(
	'block'      // The block property.
	'element'    // The element property.
	['modifier'] // The modifier property. Array, doesn't support strings.
	''           // The prefix. Optional.
);

// Output: block block--modifier
echo $bem->scope();
```

**Note:**
Even though it's possible to pass all of the parameters, when both *block* and *modifiers* are passed
the *element* is ignored.

This is right and in line with the BEM requirements. Infact isn't possible to have a BEM string like `block block--modifier__element`.

### Add more than one modifier

It's possible to pass more than one modifier as you can see by the type hint of the class.

So for example, the following code will output `block block--modifier-one block--modifier-two`.

```php
$bem = new \Unprefix\Bem\BemPrefixed('block', '', ['modifier-one', 'modifier-two']);

// Will output block block--modifier-one block--modifier-two.
echo $bem->scope();
```

No checks are made to the string for *block*, *element* or *modifiers* so, strings like `block--name` or `block--modifier__element` are valid `block` strings along as *element* or *modifiers*.

So, passing the correct value is completely up to you.

### Retrieve properties.

To retrieve properties, simply ask for them.

```php
$bem = new \Unprefix\Bem\BemPrefixed('block', 'element', ['modifier']);

// Will be assigned 'block'.
$block = $bem->block();

// Will be assigned 'element'.
$element = $bem->element();

// Will be assigned ['modifier'].
$modifiers = $bem->modifiers();
```

### About the Prefix

It's a common way to prefix the css classes to prevent conflict with other libraries.

The BemPrefixed (as the name says) support prefixes.

```php
$bem = new \Unprefix\Bem\BemPrefixed('block', 'element', [], 'prefix');

// Will output 'prefixblock__element'.
echo $bem->scope();
```

## Bugs

To report a bug simply open an [issue on github project](https://github.com/widoz/bem/issues)

## License

The library is released under GPL-2 Gnu General Public License.

For more info please visit the [the general public license](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html) page.