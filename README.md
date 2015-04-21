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
private function createTable($url)
{
 $table = BootstrapTableHelper::table()
            ->setOptions(BootstrapTableHelper::TABLE_SEARCH, true)
            ->setOptions(BootstrapTableHelper::TABLE_SHOW_REFRESH, true)
            ->setOptions(BootstrapTableHelper::TABLE_SHOW_COLUMNS, true)
            ->setOptions(BootstrapTableHelper::TABLE_SHOW_TOGGLE, true)
            ->setOptions(BootstrapTableHelper::TABLE_PAGINATION, true)
            ->setOptions(BootstrapTableHelper::TABLE_SIDE_PAGINATION, 'server')
            ->setOptions(BootstrapTableHelper::TABLE_URL, $url)
            ->setOptions(BootstrapTableHelper::TABLE_SORT_NAME, 'code')
            ->addColumn('code', 'Code', true, true)
            ->addColumn('description', 'Memo', true, true)
            ->addColumn('quantity', 'Quantity', true, false)
            ->addColumn('weight', 'Weight', true, false);
        
        //if not defined use request    
        if ($url == '') {
            $table->useRequestLaravel();
        }
            
  return $table
}

protected function getData()
{
  return $this->createTable('')->buildData(Data::select());
}
```

In alternative unique route BootstrapTableHelper::shouldHandle()
```
protected function index()
{
  if (BootstrapTableHelper::shouldHandle()) {
    return $this->getData();
  } else {
    return View::make('data',['table' => $this->createTable(''),]);
  }
}
```

In view 

```
{{$table->render()}}
```

