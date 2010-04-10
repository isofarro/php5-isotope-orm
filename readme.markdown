PHP5 Isotope ORM
================

A flexible schema-based object-model store. This is very much experimental and a prototype of a few ideas of clean and simple object data stores.

* Input and output are simple PHP data-value objects
* Virtual/variable functions to query/filter object model
* Schema based on object structure, so can relationally map to other SQL tables
* Define object schemas declaratively or procedurally
* Introspect an object to automatically generate a basic/raw object schema
* Object schema is persistent
* Schemas can be refined, altered or adapted; add in new indexes
* Support tree-like object structures
* Support network-like object structures

Currently the actual datasource is a PDO-compliant database.

