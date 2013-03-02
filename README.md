TinyPHP
=======

A small framework for PHP-MySQL websites. Has a basic template engine, with some simple query management. Provides parent classes for abstraction

All function that take a filename will call the file relative_to_its_calling_script. So, whenever you specify a filename for the template, the `Template` class will look relative to its directory. That being said, for classes that read other files, I suggest keeping them in the directory (or a subdirectory) of its calling script.

## How to setup a project ##
1. [Setup database configuration](#db)
2. [Add SQL scripts](#sql)
3. [Add models](#models)
4. [Add handlers](#handlers)
5. [Add templates](#templates)
6. [Create pages](#pages)

### <a name='db'/> Database Setup
To setup your database, go to the db folder, and change the values in the database configuration array. Each value corresponds to values in the connection string: User is the name of the database user, Pass is the password for that user, Name is the name of the database within MySQL to connect to, and Host is the host where the database is stored.

### <a name='sql'/>SQL scripts
To separate SQL from PHP, place each query you might need in the queries folder (or possibly subfolders by model-name, query-type, etc). The queries support `:fieldName` syntax from PHP PDO parameterized queries, so feel free to use them. Whenever the QueryManager executes an SQL script, it attempts to bind parameters to it by looking at the object passed into the `query` function. So if your model is a class like 
```PHP
class Model
{
  public $id;
  public $value;
}
```
and you call the query manager with a SQL script filename and an instance of this object, the Query Manager will look for parameters `:id` and `:value` and attempt to bind them with the values in the object. 

### <a name='models'/> Adding Models
You have free reign for building models, as there is no template or base class for them. However, I personally use an ActiveRecord imitation pattern. I add public fields for each column in the database, and add a save, delete, and get function. In the querying functions, you can import the `QueryManager` and use that (along with your SQL you wrote) to get stuff out of the database. For example:
```PHP
// to include
require_once(SQL . 'QueryManager.php');
// now to query
QueryManager::query('filename.sql', $obj);
```
Remember, the QueryManager will attempt to bind all of the variables in the script you provide. Any variables it cannot find in the parameterized SQL statement it ignores.

### <a name='handlers'/> Creating Handlers
There is a basic form class you can inherit from. It essentially provides a static method that expects the $_GET, $_POST, and $_FILE superglobals and expects you to do something with them. These can be used to save a new model, or load a model from the database to view (and potentially edit). This is done by returning a context
A context is an associative array containing all of the variables you want to define for you template. The way this happens is detailed in the next section.

### <a name='templates'/> Templating
The template engine has a static method ` Template::renderTemplateWithContext('template.php', $context);` that takes a string filename and a context. The context should be an associative array, like:
```PHP
$context = array(
  'user' => 'bob',
  'friend' => 'alice'
);
```
When the template engine processes this context, it will define variables in your template file, as if you had written:
```PHP
$user = 'bob';
$friend = 'alice';
```
So in this way, using your handlers, you can define the variables you want to exist (and later use) in your template.

Template files themselves are simply PHP and HTML intermingled. However, to improve the readability of your code, you may want to define some renderers for you models, or forms, or whatever. A renderer essentially has a render function that emits HTML given its state. So for you model, you may have a renderer that prints it out, and another renderer that generates a form for editing and creating an instance of that model. For instance:
```PHP
require_once(RENDERERS . 'Renderer.php');
class ModelRenderer implements Renderer
{
  private $model;
  public function __construct__($model)
  {
    $this -> model = $model;
  }
  public function render()
  {
    echo "<p>Model: " . $this -> model -> name . "</p>";
  }
}
```

### <a name='pages'/> Creating Pages
Pages are the actual file that the user visits, such as index.php. In this file, you build your context (using either a handler, or statically), then render a template for the context. Consider a simple version:
```PHP
require_once(HANDLERS . 'MyCoolHandler.php');
require_once(TEMPLATE . 'Template.php');
$context = MyCoolHandler::processForm($_GET, $_POST, $_FILES);
Template::renderTemplateWithContext('templateFile.php', $context);
```

## Summary
These templates don't enforce any certain behavior, but they do provide a project structure that helps. Sample index file is included for your pleasure. Enjoy!
