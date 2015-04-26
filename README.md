#To Do List App
###(Again, but with categories)

Kyle Bulloch and Patrick Fiorentino
03.18.2015

####Description

This app allows the user to create to do lists, with categories for organization.  Built for Epicodus as an exercise in PHP and PostgreSQL databases.

####Setup

On a mac run these commands in your terminal:
```
git clone https://github.com/kbulloch/to_do_with_categories.git

cd to_do_with_categories/web

php -S localhost:8000

(then in a new terminal window)

postgres

(then in a new terminal tab)

psql
CREATE DATABASE to_do;
\c to_do;
CREATE TABLE categories (id serial PRIMARY KEY, name varchar);
CREATE TABLE tasks (id serial PRIMARY KEY, description varchar, category_id int, due_date varchar);
CREATE DATABASE to_do_test WITH TEMPLATE to_do;
\c to_do_test;
```

The MIT License

Copyright (c) 2015 Kyle Bulloch

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
