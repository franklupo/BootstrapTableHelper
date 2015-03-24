<?php

/**
 * Helper for bootstrap-table
 * https://github.com/wenzhixin/bootstrap-table
 *
 * Corsinvest Srl
 * Danile Corsini
 *
 * Web: http://www.corsinvest.it
 * Mail: daniele.corsini@corsinvest .it
 *
 * Class BootstrapTableHelper
 */
class BootstrapTableHelper
{
    private $columns = [];
    private $url = '';
    private $toolbar = '';
    private $sortName = '';
    private $idName = '';
    private $showRefresh = true;
    private $showSerach = true;
    private $showColumns = true;
    private $showToggle = true;
    private $showCheckboxSelect = false;
    private $pageList = '[5, 10, 25, 50, 100]';
    private $pageSize = 10;
    private $pageNumber = 1;
    private $showCardView = false;
    private $exactWordSearch = false;
    private $tableClass = 'table table-striped table-hover table-condensed';
    private $striped = true;
    private $toolbarAlign = 'left';
    private $queryParams = null;
    private $pagination = false;
    private $sidePagination='client';

    const COLUMN_ATTR_NAME = 'name';
    const COLUMN_ATTR_TITLE = 'title';
    const COLUMN_ATTR_SORTABLE = 'sortable';
    const COLUMN_ATTR_SEARCHABLE = 'searchable';
    const COLUMN_ATTR_VISIBLE = 'visible';
    const COLUMN_ATTR_SWITCHABLE = 'switchable';
    const COLUMN_ATTR_SEARCH_EXACT = 'searchExact';

    /**
     * php function create result, take one parameter:
     * row: the row record data.
     */
    const COLUMN_ATTR_PHP_FUNCTION = 'php_function';

    /**
     * False to hide the columns item in card view state.
     */
    const COLUMN_ATTR_CARD_VISIBLE = 'card-visible';

    /**
     * The column class name.
     */
    const COLUMN_ATTR_CARD_CLASS = 'data-class';

    /**
     * The cell formatter javascript function, take three parameters:
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     */
    const COLUMN_ATTR_JS_FORMATTER = 'formatter';

    /**
     * The cell events listener javascript when you use formatter function, take three parameters:
     * event: the jQuery event.
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     */
    const COLUMN_ATTR_JS_EVENTS = 'events';

    /**
     * The cell style formatter function, take three parameters:
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     * Support classes or css.
     */
    const COLUMN_ATTR_JS_CELL_STYLE = 'cell-style';

    /**
     * Format result
     */
    const COLUMN_ATTR_PHP_FORMAT = 'php_format';

    const COLUMN_FORMAT_NONE = -1;
    const COLUMN_FORMAT_DATE = 0;
    const COLUMN_FORMAT_TIME = 1;
    const COLUMN_FORMAT_DATE_TIME = 2;
    const COLUMN_FORMAT_FORMATTED_DATE = 3;
    const COLUMN_FORMAT_DAY_DATE = 4;
    const COLUMN_FORMAT_CUSTOM = 5;

    /**
     * @param $name
     * @param $title
     * @param bool $sortable
     * @param bool $searchable
     * @param null $php_function
     * @param bool $visible
     * @param bool $switchable
     * @param bool $searchExact
     * @param int $format
     * @return $this
     */
    public function addColumn($name,
                              $title,
                              $sortable = false,
                              $searchable = false,
                              $php_function = null,
                              $visible = true,
                              $switchable = true,
                              $searchExact = false,
                              $format = self::COLUMN_FORMAT_NONE)
    {
        $data = [
            self::COLUMN_ATTR_NAME => $name,
            self::COLUMN_ATTR_TITLE => $title,
            self::COLUMN_ATTR_SORTABLE => $sortable,
            self::COLUMN_ATTR_SEARCHABLE => $searchable,
            self::COLUMN_ATTR_PHP_FUNCTION => $php_function,
            self::COLUMN_ATTR_VISIBLE => $visible,
            self::COLUMN_ATTR_SWITCHABLE => $switchable,
            self::COLUMN_ATTR_SEARCH_EXACT => $searchExact,
            self::COLUMN_ATTR_PHP_FORMAT => $format,
        ];

        $this->columns = array_add($this->columns, $name, $data);

        return $this;
    }

    public function &getColumn($name)
    {
        return $this->columns[$name];
    }

    public function setAttrColumn($name, $attr, $value)
    {
        $this->getColumn($name)[$attr] = $value;
        return $this;
    }

    public function &getAttrColumn($name, $attr)
    {
        $this->getColumn($name)[$attr];
    }

    /**
     * @return bool True if the plugin should handle this request, false otherwise
     */
    public static function shouldHandle()
    {
        return Input::has('order');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setExactWordSearch($value = false)
    {
        $this->exactWordSearch = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function getExactWordSearch()
    {
        return $this->exactWordSearch;
    }

    /**
     * @param $value Sets up a lookup table for which columns should use exact matching
     * @return $this
     */
    public function setExactMatchColumns($value = [])
    {
        foreach ($value as $name) {
            getColumn($name)[self::COLUMN_ATTR_SEARCH_EXACT] = true;
        }

        return $this;
    }

    /**
     * Create table
     * @return $this
     */
    public static function table()
    {
        $table = new static;

        //set random name
        $table->setId(str_random(8));
        return $table;
    }

    /**
     * Get id table.
     * @return string
     */
    public function getId()
    {
        return $this->idName;
    }

    /**
     * Set id table.
     * @param string $value
     * @return $this
     */
    public function setId($value)
    {
        $this->idName = $value;
        return $this;
    }

    /**
     * Get which column can be sorted.
     * @return string
     */
    public function getSortName()
    {
        return $this->sortName;
    }

    /**
     * Set which column can be sorted.
     * @param $value
     * @return $this
     */
    public function setSortName($value = '')
    {
        $this->sortName = $value;
        return $this;
    }

    /**
     * Get URL to request data from remote site.
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set URL to request data from remote site.
     * @param $value
     * @return $this
     */
    public function setUrl($value)
    {
        $this->url = $value;
        return $this;
    }

    /**
     * Set jQuery selector that indicate the toolbar, for example: #toolbar, .toolbar.
     * @param $value
     * @return $this
     */
    public function setToolbar($value)
    {
        $this->toolbar = $value;
        return $this;
    }

    /**
     * Get jQuery selector that indicate the toolbar, for example: #toolbar, .toolbar.
     * @return string
     */
    public function getToolbar()
    {
        return $this->toolbar;
    }

    /**
     * Indicate how to align the custom toolbar. 'left', 'right' can be used.
     * @param string $value
     * @return $this
     */
    public function setToolbarAlign($value = 'left')
    {
        $this->toolbarAlign = $value;
        return $this;
    }

    /**
     * Indicate how to align the custom toolbar. 'left', 'right' can be used.
     * @return string
     */
    public function getToolbarAlign()
    {
        return $this->toolbarAlign;
    }

    /**
     * Show the refresh button.
     * @param $value
     * @return $this
     */
    public function setShowRefresh($value)
    {
        $this->showRefresh = $value;
        return $this;
    }

    /**
     * Show the refresh button.
     * @return bool
     */
    public function getShowRefresh()
    {
        return $this->showRefresh;
    }

    /**
     * Enable the search input.
     * @param $value
     * @return $this
     */
    public function setShowSearch($value = true)
    {
        $this->showSerach = $value;
        return $this;
    }

    /**
     * Enable the search input.
     * @return bool
     */
    public function getShowSearch()
    {
        return $this->showSerach;
    }

    /**
     * Show the columns drop down list.
     * @param $value
     * @return $this
     */
    public function setShowColumns($value = true)
    {
        $this->showColumns = $value;
        return $this;
    }

    /**
     * Show the columns drop down list.
     * @return bool
     */
    public function getShowColumns()
    {
        return $this->showColumns;
    }

    /**
     * Show the toggle button to toggle table / card view.
     * @param $value
     * @return $this
     */
    public function setShowToggle($value)
    {
        $this->showToggle = $value;
        return $this;
    }

    /**
     * Show the toggle button to toggle table / card view.
     * @return bool
     */
    public function getShowToggle()
    {
        return $this->showToggle;
    }

    /**
     * Select checkbox or radiobox when the column is clicked.
     * @param $value
     * @return $this
     */
    public function setShowCheckboxSelect($value)
    {
        $this->showCheckboxSelect = $value;
        return $this;
    }

    /**
     * Select checkbox or radiobox when the column is clicked.
     * @return bool
     */
    public function getShowCheckboxSelect()
    {
        return $this->showCheckboxSelect;
    }

    /**
     * When set pagination property, initialize the page size selecting list.
     * If you include the 'All' option, all the records will be shown in your table
     * @param $value
     * @return $this
     */
    public function setPageList($value = '[5, 10, 25, 50, 100]')
    {
        $this->pageList = $value;
        return $this;
    }

    /**
     * When set pagination property, initialize the page size selecting list.
     * If you include the 'All' option, all the records will be shown in your table
     * @return string
     */
    public function getPageList()
    {
        return $this->pageList;
    }

    /**
     * When set pagination property, initialize the page size.
     * @param $value
     * @return $this
     */
    public function setPageSize($value = 10)
    {
        $this->pageSize = $value;
        return $this;
    }

    /**
     * When set pagination property, initialize the page size.
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * When set pagination property, initialize the page number.
     * @param $value
     * @return $this
     */
    public function setPageNumber($value = 1)
    {
        $this->pageNumber = $value;
        return $this;
    }

    /**
     * When set pagination property, initialize the page number.
     * @return null
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * True to show card view table, for example mobile view.
     * @param $value
     * @return $this
     */
    public function setShowCardView($value)
    {
        $this->showCardView = $value;
        return $this;
    }

    /**
     * True to show card view table, for example mobile view.
     * @return bool
     */
    public function getShowCardView()
    {
        return $this->showCardView;
    }

    /**
     * The class name of table.
     * @param $value
     * @return $this
     */
    public function setTableClass($value = 'table table-striped table-hover table-condensed')
    {
        $this->tableClass = $value;
        return $this;
    }

    /**
     * The class name of table.
     * @return string
     */
    public function getTableClass()
    {
        return $this->tableClass;
    }

    /**
     * True to stripe the rows.s
     * @param $value
     * @return $this
     */
    public function setStriped($value = true)
    {
        $this->striped = $value;
        return $this;
    }

    /**
     * When requesting remote data, you can send additional parameters by modifying queryParams.
     * @return null
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * When requesting remote data, you can send additional parameters by modifying queryParams.
     * @param null $value
     * @return $this
     */
    public function setQueryParams($value = null)
    {
        $this->queryParams = $value;
        return $this;
    }

    public function getStriped()
    {
        return $this->striped;
    }

    /**
     * True to show a pagination toolbar on table bottom.
     * @param bool $value
     * @return $this
     */
    public function setPagination($value = false)
    {
        $this->pagination = $value;
        return $this;
    }

    /**
     * Defines the side pagination of table, can only be 'client' or 'server'.
     * @return mixed
     */
    public function getSidePagination()
    {
        return $this->sidePagination;
    }

    /**
     * Defines the side pagination of table, can only be 'client' or 'server'.
     * @param string $value
     * @return $this
     */
    public function setSidePagination($value = 'client')
    {
        $this->sidePagination = $value;
        return $this;
    }

    /**
     * True to show a pagination toolbar on table bottom.
     * @return mixed
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Render table Html.
     * @return string
     */
    public function render()
    {
        if ($this->url == '') {
            $this->setUrl(Request::url());
        }

        $options =
            [
                'id' => $this->getId(),
                'name' => $this->getId(),
                'data-toggle' => 'table',
                'data-url' => $this->url,
                'data-classes' => $this->getTableClass(),
                'data-striped' => $this->getStriped(),
                'data-search' => $this->getShowSearch(),
                'data-show-refresh' => $this->getShowRefresh(),
                'data-show-toggle' => $this->getShowToggle(),
                'data-show-columns' => $this->getShowColumns(),
                'data-pagination' => $this->getPagination(),
                'data-side-pagination' => $this->getSidePagination(),
                'data-page-list' => $this->getPageList(),
                'data-page-size' => $this->getPageSize(),
                'data-card-view' => $this->getShowCardView(),
                'data-toolbar-align' => $this->getToolbarAlign(),
            ];

        if ($this->getQueryParams() != null) {
            $options = array_add($options, 'data-query-params', $this->getQueryParams());
        }

        if ($this->getPageNumber() != null) {
            $options = array_add($options, 'data-page-number', $this->getPageNumber());
        }

        if ($this->getToolbar() != '') {
            $options = array_add($options, 'data-toolbar', $this->getToolbar());
        }

        if ($this->getSortName() != '') {
            $options = array_add($options, 'data-sort-name', $this->getSortName());
        }

        if ($this->getShowCheckboxSelect()) {
            $options = array_add($options, 'data-click-to-select', 'true');
        }

        $ret = '<table';
        foreach ($options as $key => $value) {
            $ret .= ' ' . $key . '="' . $value . '"';
        }
        $ret .= '>';

        $ret .= '<thead><tr>';

        //check selezione
        if ($this->getShowCheckboxSelect()) {
            $ret .= '<th data-field="state" data-checkbox="true"></th>';
        }

        foreach ($this->columns as $key => $value) {
            $ret .= '<th';
            $ret .= ' data-field="' . $key . '"';

            if ($value[self::COLUMN_ATTR_SORTABLE]) {
                $ret .= ' data-sortable="true"';
            }

            if (!$value[self::COLUMN_ATTR_VISIBLE]) {
                $ret .= ' data-visible="false"';
            }

            if (!$value[self::COLUMN_ATTR_SWITCHABLE]) {
                $ret .= ' data-switchable="false"';
            }

            if (!$value[self::COLUMN_ATTR_SEARCHABLE]) {
                $ret .= ' data-searchable="false"';
            }


            if (!array_get($value, self::COLUMN_ATTR_CARD_VISIBLE, true)) {
                $ret .= ' data-card-visible="false"';
            }

            $attrVal = array_get($value, self::COLUMN_ATTR_CARD_CLASS, null);
            $ret .= $this->addAttr($attrVal != null, 'data-class', $attrVal);

            $attrVal = array_get($value, self::COLUMN_ATTR_JS_FORMATTER, null);
            $ret .= $this->addAttr($attrVal != null, 'data-formatter', $attrVal);

            $attrVal = array_get($value, self::COLUMN_ATTR_JS_EVENTS, null);
            $ret .= $this->addAttr($attrVal != null, 'data-events', $attrVal);

            $attrVal = array_get($value, self::COLUMN_ATTR_JS_CELL_STYLE, null);
            $ret .= $this->addAttr($attrVal != null, 'data-cell-style', $attrVal);

            $ret .= '>';
            $ret .= $value[self::COLUMN_ATTR_TITLE];
            $ret .= '</th>';
        }
        $ret .= '</tr></thead></table>';

        return $ret;
    }

    private function addAttr($check, $name, $value)
    {
        if ($check) {
            return ' ' . $name . '="' . $value . '"';
        }

        return '';
    }

    private function fixSystemColumn()
    {
        //quick fix for created_at, updated_at, deleted_at columns
        foreach (['created_at', 'updated_at', 'deleted_at'] as $name) {
            if (array_key_exists($name, $this->columns)) {
                $this->columns[$name][self::COLUMN_ATTR_PHP_FORMAT] == self::COLUMN_FORMAT_DAY_DATE;
            }
        }
    }

    private function fixFormatColumn()
    {
        //format value
        foreach ($this->columns as $key => $value) {
            if ($value[self::COLUMN_ATTR_PHP_FORMAT] != self::COLUMN_FORMAT_NONE &&
                $this->columns[$key][self::COLUMN_ATTR_PHP_FUNCTION] == null
            ) {
                $this->columns[$key][self::COLUMN_ATTR_PHP_FUNCTION] =
                    function ($row) use ($key) {
                        try {
                            //format value
                            switch ($this->format) {
                                case DateColumn::DATE:
                                    return $row[$key]->toDateString();

                                case DateColumn::TIME:
                                    return $row[$key]->toTimeString();

                                case DateColumn::DATE_TIME:
                                    return $row[$key]->toDateTimeString();

                                case DateColumn::CUSTOM:
                                    return $row[$key]->format($this->custom);

                                case DateColumn::FORMATTED_DATE:
                                    return $row[$key]->toFormattedDateString();

                                case DateColumn::DAY_DATE:
                                    return $row[$key]->toDayDateTimeString();
                            }
                        } catch (Exception $e) {
                            //if error show error in row
                            return $e->getMessage();
                        }
                    };
            }
        }
    }

    /**
     * Build data from query
     * @param $query
     * @return string
     */
    public function buildData($query)
    {
        $this->fixSystemColumn();
        $this->fixFormatColumn();

        //filter
        $search = Input::get('search', '');
        if ($search != '') {
            $query = $query->where(function ($query) use ($search) {
                foreach ($this->columns as $key => $value) {
                    if ($value[self::COLUMN_ATTR_SEARCHABLE]) {
                        $exactWordSearch = $this->getExactWordSearch();
                        if (!$exactWordSearch) {
                            //check single column
                            $exactWordSearch = $value[self::COLUMN_ATTR_SEARCH_EXACT];
                        }

                        if ($value[self::COLUMN_ATTR_PHP_FUNCTION] == null) {
                            $query->orWhere($key, 'like', $exactWordSearch ? $search : '%' . $search . '%');
                        }
                    }
                }
            });
        }

        //total record
        $count = $query->count();

        //limit and retrive record
        $query->skip(Input::get('offset', 0));
        $query->take(Input::get('limit', 100));

        //sort
        $sort = Input::get('sort', '');
        if ($sort != '') {
            if ($this->columns[$sort][self::COLUMN_ATTR_SORTABLE]) {
                $query = $query->orderBy($sort, Input::get('order', 'asc'));
            }
        }

        //get data
        $data = $query->get();

        //check if exists calcualted field
        $calculated = false;
        foreach ($this->columns as $key => $value) {
            if ($value[self::COLUMN_ATTR_PHP_FUNCTION] != null) {
                $calculated = true;
                break;
            }
        }

        if ($calculated) {
            //parse data
            $data = $data->map(function ($row) {
                $entry = array();

                //transfer value in column row
                foreach ($this->columns as $key => $value) {
                    //check is calculated by function
                    if ($value[self::COLUMN_ATTR_PHP_FUNCTION] == null) {
                        $entry[$key] = $row[$key];

                    } else {
                        //call function
                        try {
                            $entry[$key] = call_user_func($value[self::COLUMN_ATTR_PHP_FUNCTION], $row);
                        } catch (Exception $e) {
                            //if error show error in row
                            $entry[$key] = $e->getMessage();
                        }

                    }
                }
                return $entry;
            });
        }

        return '{"total": ' . $count . ',"rows": ' . json_encode($data) . "}";
    }
}
