# BootstrapTableHelper

Based on idea Chumper/Datatable https://github.com/Chumper/Datatable

Create a table using https://github.com/wenzhixin/bootstrap-table and laravel 


##Features

This package supports:
One file any functionality
Easy to add and order columns
Includes a simple helper for the HTML side
Use your own functions and presenters in your columns
Search in your custom defined columns
Define your specific fields for searching and ordering
Add custom javascript values for the table


##Usage

In contrelle two route
```
private function createTable()
{
  $table = BootstrapTableHelper::table()
            ->setUrl($url) //set or default Request::url()
            ->setSortName('code')
            
            //create column with function trasform
            ->addColumn('code', 'Code', true, true,function(row)
            {
              return '<a href="...">' . $row['code'] .'</a>';
            })
            ->addColumn('description', 'Memo', true, true)
            ->addColumn('quantity', 'Quantity', true, false)
            ->addColumn('weight', 'Weight', true, false)
            
            //toolbar name
            ->setToolbar('#toolbar');
            
  return $table
}

protected function getData()
{
  return $this->createTable()->buildData(Data::select());
}
```

In alternative unique route BootstrapTableHelper::shouldHandle()
```
protected function index()
{
  if (BootstrapTableHelper::shouldHandle()) {
    return $this->getData();
  } else {
    return View::make('data',['table' => $this->createTable(),]);
  }
}
```

In view 

```
{{$table->render()}}
```

