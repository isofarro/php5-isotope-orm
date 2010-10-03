Schema-based ORM:
=============

Start with a schema definition, create a class that can accurately persist and restore object data, and make the underlying data queryable.



## Defining an entity

An entity is represented by a table in a relational database. Entities have a type.

An entity is defined by:

* A list of it's properties. Each property has a logical definition, which also needs to consider it's indexable/uniqueness qualities.
* A reference to related entities. This reference also needs to consider 1-1 through to 1-M relationships.
* How to validate entity data? How to share validation across entities?
* Property level and entity level validation


## Defining relationships between entities

Entities can be joined/related to other entiteis through decorators

Tables:
* Books
* Authors
* Publisher
* Publication

Joins:
* Books decorated by Author (how is that different from an Author decorated by Books?)


* Should table names be singular or plural?
* Defining a relationship
* Handling one-to-one relationships
* Handling one-to-many relationships
* Handling many-to-many relationships
* Using decorators for joins

### Modelling joins as decorators

Code inheritance example:

	interface Book {};
	interface Author {};
	
	interface BookDecorator {};
	interface AuthorDecorator {};
	
	class BookBase {};
	class AuthorBase {};
	
	class AuthoredBooks implements BookDecorator, AuthorDecorator {};



## Defining Properties

Standard properties are:
* String
* Number
* Date
* Blob

These properties can be extended by new property types.