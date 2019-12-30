# Union Pattern For ```PHP```
php version: 7.2

### what is this ?
this is a simple code for make a union pattern project 



You can also:
  - make a easy union pattern project
  - use on laravel with ```namespace```
  - move from methods with ```next``` and ```previous``` method

### Usage:
  - include ```Union.php```
  - extends your class from ```Union``` class
  - write your methods
  - now you can call next method with ```$this->next()```

### Example:
``` php
//call next method:
$this->next();
```

``` php
//call previous method:
$this->previous();
```

``` php
//break process:
$this->break();
```

``` php
//if this method called from 'method1' go next, else go 2 method later:
if($this->comesFrom('method1')){
    $this->next();
}
$this->next(2);
```

