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
    private $options = ['data-toggle' => 'table'];
    private $exactWordSearch = false;

    ////////////////////////////////
    // TABLE OPTIONS
    ////////////////////////////////
    /**
     * The class name of table.
     * Default: 'table table-hover'
     */
    const TABLE_CLASSES = 'data-classes';

    /**
     * The height of table.
     * Default: undefined
     */
    const TABLE_HEIGHT = 'data-height';

    /**
     * Defines the default undefined text.
     * Default: '-'
     */
    const TABLE_UNDEFINED_TEXT = 'data-undefined-text';

    /**
     * True to stripe the rows.
     * Default: false
     */
    const TABLE_STRIPED = 'data-striped';

    /**
     * Defines which column can be sorted.
     * Default: undefined
     */
    const TABLE_SORT_NAME = 'data-sort-name';

    /**
     * Defines the column sort order, can only be 'asc' or 'desc'.
     * Default: 'asc'
     */
    const TABLE_SORT_ORDER = 'data-sort-order';

    /**
     * Defines icon set name ('glyphicon' or 'fa' for FontAwesome). By default 'glyphicon' is used.
     * Default: 'glyphicon'
     */
    const TABLE_ICONS_PREFIX = 'data-icons-prefix';

    /**
     * Defines icons that used for refresh, toggle and columns buttons
     * Default:
     * {
     *    refresh: 'glyphicon-refresh icon-refresh',
     *    toggle: 'glyphicon-list-alt icon-list-alt',
     *    columns: 'glyphicon-th icon-th'
     * }
     */
    const TABLE_ICONS = 'data-icons';

    /*
        columns	-	Array	[]	The table columns config object, see column properties for more details.
        data	-	Array	[]	The data to be loaded.
     */

    /**
     * The method type to request remote data.
     * Default: get
     */
    const TABLE_METHOD = 'data-method';

    /**
     * A URL to request data from remote site.
     * Default: undefined
     */
    const TABLE_URL = 'data-url';

    /**
     * False to disable caching of AJAX requests.
     * Default: true
     */
    const TABLE_CACHE = 'data-cache';

    /**
     * The contentType of request remote data.
     * Default: 'application/json'
     */
    const TABLE_CONTENT_TYPE = 'data-content-type';

    /**
     * The type of data that you are expecting back from the server.
     * Default: 'json'
     */
    const TABLE_DATA_TYPE = 'data-data-type';

    /**
     * Additional options for submit ajax request.
     * List of values: http://api.jquery.com/jQuery.ajax.
     * Default: {}
     */
    const TABLE_AJAX_OPTIONS = 'data-ajax-options';

    /**
     * When requesting remote data, you can send additional parameters by modifying queryParams.
     * If queryParamsType = 'limit', the params object contains:
     * limit, offset, search, sort, order
     * Else, it contains:
     * pageSize, pageNumber, searchText, sortName, sortOrder.
     * Return false to stop request.
     * Default:
     * function(params) { return params; }
     */
    const TABLE_QUERY_PARAMS = 'data-query-params';

    /**
     * Set 'limit' to send query params width RESTFul type.
     * Default: 'limit'
     */
    const TABLE_QUERY_PARAMS_TYPE = 'data-query-params-type';

    /**
     * Before load remote data, handler the response data format, the parameters object contains:
     * res: the response data.
     * Default: function(res) { return res; }
     */
    const TABLE_RESPONSE_HANDLER = 'data-response-handler';

    /**
     * True to show a pagination toolbar on table bottom.
     * Default: false
     */
    const TABLE_PAGINATION = 'data-pagination';

    /**
     * Defines the side pagination of table, can only be 'client' or 'server'.
     * Default: client
     */
    const TABLE_SIDE_PAGINATION = 'data-side-pagination';

    /**
     * When set pagination property, initialize the page number.
     * Default: 1
     */
    const TABLE_PAGE_NUMBER = 'data-page-number';

    /**
     * When set pagination property, initialize the page size.
     * Default: 10
     */
    const TABLE_PAGE_SIZE = 'data-page-size';

    /**
     * When set pagination property, initialize the page size selecting list.
     * If you include the 'All' option, all the records will be shown in your table
     * Default: [10, 25, 50, 100, All]
     */
    const TABLE_PAGE_LIST = 'data-page-list';

    /**
     * The name of radio or checkbox input.
     * Default: 'btSelectItem'
     */
    const TABLE_SELECT_ITEM_NAME = 'data-select-item-name';

    /**
     * True to display pagination or card view smartly.
     * Default: true
     */
    const TABLE_SMART_DISPLAY = 'data-smart-display';

    /**
     * Enable the search input.
     * Default: false
     */
    const TABLE_SEARCH = 'data-search';

    /**
     * When set search property, initialize the search text.
     * Default: ''
     */
    const TABLE_SEARCH_TEXT = 'data-search-text';

    /**
     * Set timeout for search fire.
     * Default: 500
     */
    const TABLE_SEARCH_TIMEOUT = 'data-search-time-out';

    /**
     * False to hide the table header.
     * Default: true
     */
    const TABLE_SHOW_HEADER = 'data-show-header';

    /**
     * If true shows summary footer row.
     * Default: false
     */
    const TABLE_SHOW_FOOTER = 'data-show-footer';

    /**
     * True to show the columns drop down list.
     * Default: false
     */
    const TABLE_SHOW_COLUMNS = 'data-show-columns';

    /**
     * True to show the refresh button.
     * Default: false
     */
    const TABLE_SHOW_REFRESH = 'data-show-refresh';

    /**
     * True to show the toggle button to toggle table / card view.
     * Default: false
     */
    const TABLE_SHOW_TOGGLE = 'data-show-toggle';

    /**
     * True to show the pagination switch button.
     * Default: false
     */
    const TABLE_SHOW_PAGINATION_SWITCH = 'showPaginationSwitch';

    /**
     * The minimum count columns to hide of the columns drop down list.
     * Default: 1
     */
    const TABLE_MINIMUM_COUNT_COLUMNS = 'data-minimum-count-columns';

    /**
     * Indicate which field is an identity field.
     * Default: undefined
     */
    const TABLE_ID_FIELD = 'data-id-field';

    /**
     * Indicate an unique identifier for each row.
     * Default: undefined
     */
    const TABLE_UNIQUE_ID = 'data-unique-id';

    /**
     * True to show card view table, for example mobile view.
     * Default: false
     */
    const TABLE_CARD_VIEW = 'data-card-view';

    /**
     * A jQuery selector that indicate the toolbar, for example: #toolbar, .toolbar.
     * Default: undefined
     */
    const TABLE_TOOLBAR = 'data-toolbar';

    /**
     * True to select checkbox or radiobox when click rows.
     * Default: false
     */
    const TABLE_CLICK_TO_SELECT = 'data-click-to-select';

    /**
     * False to disable sortable of all columns.
     * Default: true
     */
    const TABLE_SORTABLE = 'data-sortable';

    /**
     * True to allow checkbox selecting only one row.
     * Default: false
     */
    const TABLE_SINGLE_SELECT = 'data-single-select';

    /**
     * The row style formatter function, take two parameters:
     * row: the row record data.
     * index: the row index.
     * Support classes or css.
     * Default: {}
     */
    const TABLE_ROW_STYLE = 'data-row-style';

    /**
     * The row attribute formatter function, take two parameters:
     * row: the row record data.
     * index: the row index.
     * Support all custom attributes.
     * Default: {}
     */
    const TABLE_ROW_ATTRIBUTES = 'data-row-attributes';

    /**
     * True to enable the key events. For now when the user presses the "S" or "s" key the search button will be focused.
     * Default: false
     */
    const TABLE_KEY_EVENTS = 'data-key-events';

    /**
     * False to hide check-all checkbox in header row.
     * Default: true
     */
    const TABLE_CHECKBOX_HEADER = 'data-checkbox-header';

    /**
     * Indicate how to align the search input. 'left', 'right' can be used.
     * Default: 'right'
     */
    const TABLE_SEARCH_ALIGN = 'data-search-align';

    /**
     * Indicate how to align the toolbar buttons. 'left', 'right' can be used.
     * Default: 'right'
     */
    const TABLE_BUTTONS_ALIGN = 'data-buttons-align';

    /**
     * Indicate how to align the custom toolbar. 'left', 'right' can be used.
     * Default: 'left'
     */
    const TABLE_TOOLBAR_ALIGN = 'data-toolbar-align';

    /**
     * Indicate how to align the pagination. 'top', 'bottom', 'both' (put the pagination on top and bottom) can be used.
     * Default: 'bottom'
     */
    const TABLE_PAGINATION_V_ALIGN = 'data-pagination-v-align';

    /**
     * Indicate how to align the pagination. 'left', 'right' can be used.
     * Default: 'right'
     */
    const TABLE_PAGINATION_H_ALIGN = 'data-pagination-h-align';

    /**
     * Indicate how to align the pagination detail. 'left', 'right' can be used.
     * Default: 'left'
     */
    const TABLE_PAGINATION_DETAIL_H_ALIGN = 'data-pagination-detail-h-align';

    /**
     * Indicate the icon or text to be shown in the pagination detail, the first button of the pagination detail.
     * Default: '<<'
     */
    const TABLE_PAGINATION_PAGINATION_FIRST_TEXT = 'data-pagination-first-text';

    /**
     * Indicate the icon or text to be shown in the pagination detail, the previous button.
     * Default: '<'
     */
    const TABLE_PAGINATION_PAGINATION_PRE_TEXT = 'data-pagination-pre-text';

    /**
     * Indicate the icon or text to be shown in the pagination detail, the next button.
     * Default: '>'
     */
    const TABLE_PAGINATION_PAGINATION_NEXT_TEXT = 'data-pagination-next-text';

    /**
     * Indicate the icon or text to be shown in the pagination detail, the last button.
     * Default: '>>'
     */
    const TABLE_PAGINATION_PAGINATION_LAST_TEXT = 'data-pagination-last-text';

    /**
     * True to maintain selected rows on change page and search.
     * Default: false
     */
    const TABLE_MAINTAIN_SELECTED = 'data-maintain-selected';

    ////////////////////////////////
    // COLUMN OPTIONS
    ////////////////////////////////

    /**
     * The column field name.
     */
    const COLUMN_FIELD = 'data-field';

    /**
     * The column title text.
     */
    const COLUMN_TITLE = 'data-title';

    /**
     * False to hide the columns item.
     * Default: true
     */
    const COLUMN_VISIBLE = 'data-visible';

    /**
     * True to allow the column can be sorted.
     * Default: false
     */
    const COLUMN_SORTABLE = 'data-sortable';

    /**
     * True to search data for this column.
     * Default: true
     */
    const COLUMN_SEARCHABLE = 'data-searchable';

    /**
     * The default sort order, can only be 'asc' or 'desc'.
     * Default: 'asc'
     */
    const COLUMN_ORDER = 'data-order';

    /**
     * The column class name.
     * Default: undefined
     */
    const COLUMN_CLASS = 'class';

    /**
     * The cell events listener javascript when you use formatter function, take three parameters:
     * event: the jQuery event.
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     * Default: undefined
     */
    const COLUMN_EVENTS = 'data-events';

    /**
     * The cell style formatter function, take three parameters:
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     * Support classes or css.
     * Default: undefined
     */
    const COLUMN_CELL_STYLE = 'data-cell-style';

    /**
     * The cell formatter javascript function, take three parameters:
     * value: the field value.
     * row: the row record data.
     * index: the row index.
     * Default: undefined
     */
    const COLUMN_FORMATTER = 'data-formatter';

    /**
     * False to disable the switchable of columns item.
     * Default: true
     */
    const COLUMN_SWITCHABLE = 'data-switchable';

    /**
     * False to hide the columns item in card view state.
     * Default: true
     */
    const COLUMN_CARD_VIEW_VISIBLE = 'data-card-visible';

    /**
     * True to show a radio. The radio column has fixed width.
     * Default: false
     */
    const COLUMN_RADIO = 'data-radio';

    /**
     * True to show a checkbox. The checkbox column has fixed width.
     * Default: false
     */
    const COLUMN_CHECKBOX = 'data-checkbox';

    /**
     * The width of column. If not defined, the width will auto expand to fit its contents.
     * Default: undefined
     */
    const COLUMN_WIDTH = 'data-width';

    /**
     * Indicate how to align the column data. "left', 'right', 'center' can be used.
     * Default: undefined
     */
    const COLUMN_ALIGN = 'data-align';

    /**
     * Indicate how to align the table header. 'left', 'right', 'center' can be used.
     * Default: undefined
     */
    const COLUMN_HALIGN = 'data-halign';

    /**
     * Indicate how to align the table footer. 'left', 'right', 'center' can be used.
     * Default: undefined
     */
    const COLUMN_FALIGN = 'data-falign';

    /**
     * Indicate how to align the cell data. 'top', 'middle', 'bottom' can be used.
     * Default: undefined
     */
    const COLUMN_VALIGN = 'data-valign';

    /**
     * True to select checkbox or radiobox when the column is clicked.
     * Default: true
     */
    const COLUMN_CLICK_TO_SELECT = 'data-click-to-select';

    /**
     * The context (this) is the column Object. The function, take one parameter:
     * data: Array of all the data rows.
     * the function should return a string with the text to show in the footer cell.
     * Default: undefined
     */
    const COLUMN_FOOTER_FORMATTER = 'data-footer-formatter';

    /**
     * The custom field sort function that used to do local sorting, take two parameters:
     * a: the first field value.
     * b: the second field value.
     * Default: undefined
     */
    const COLUMN_SORTER = 'data-sorter';

    /**
     * Exact search for column
     * true -> like 'value'
     * false  -> like '%value%'
     * Default false
     */
    const COLUMN_DATA_SEARCH_EXACT = 'searchExact';

    /**
     * php function create result, take one parameter:
     * row: the row record data.
     */
    const COLUMN_PHP_FUNCTION = 'php_function';

    /**
     * Format result
     */
    const COLUMN_PHP_FORMAT = 'php_format';

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
     * @param null $function
     * @return $this
     */
    public function addColumn($name,
                              $title,
                              $sortable = false,
                              $searchable = true,
                              $function = null)
    {
        $data = [
            self::COLUMN_FIELD => $name,
            self::COLUMN_TITLE => $title,
            self::COLUMN_SORTABLE => $sortable,
            self::COLUMN_SEARCHABLE => $searchable,
            self::COLUMN_PHP_FUNCTION => $function,
        ];

        $this->columns = array_add($this->columns, $name, $data);

        return $this;
    }

    public function &getColumns()
    {
        return $this->columns;
    }

    /**
     * Return column position.
     * @param $name
     * @return mixed
     */
    public function getColumnPosition($name)
    {
        return array_search($name, array_keys($this->columns));
    }

    /**
     * Change column position.
     *
     * @param $name
     * @param $pos
     * @return $this
     */
    public function setColumnPosition($name, $pos)
    {
        //move column
        $data = array_splice($this->columns, $this->getColumnPosition($name), 1);
        array_splice($this->columns, $pos, 0, $data);

        //rename column from 0 to column name
        $keys = array_keys($this->columns);
        $keys[array_search('0', array_values($keys))] = $data[$name][self::COLUMN_FIELD];
        $this->columns = array_combine($keys, $this->columns);

        return $this;
    }

    public function &getColumn($name)
    {
        return $this->columns[$name];
    }

    public function setColumnAttr($name, $key, $value)
    {
        $this->getColumn($name)[$key] = $value;
        return $this;
    }

    public function &getColumnAttr($name, $key, $default = null)
    {
        if (array_key_exists($key, $this->getColumn($name))) {
            return $this->getColumn($name)[$key];
        } else {
            return $default;
        }
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
            self::getColumn($name)[self::COLUMN_DATA_SEARCH_EXACT] = true;
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
        return $this->getOptions('id');
    }

    /**
     * Set id table.
     * @param string $value
     * @return $this
     */
    public function setId($value)
    {
        $this->setOptions('id', $value);
        $this->setOptions('name', $value);
        return $this;
    }

    /**
     * Use request laravel Request::url()
     * @return $this
     */
    public function useRequestLaravel()
    {
        $this->setOptions(self::TABLE_URL, Request::url());
        return $this;
    }

    public function setOptions($key, $value)
    {
        array_set($this->options, $key, $value);
        return $this;
    }

    public function &getOptions($key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        } else {
            return $default;
        }
    }

    /**
     * Render table Html.
     * @return string
     */
    public function render()
    {
        $ret = '<table';
        foreach ($this->options as $key => $value) {
            if (is_bool($value) === true) {
                $ret .= ' ' . $key . '="' . ($value ? 'true' : 'false') . '"';
            } else {
                $ret .= ' ' . $key . '="' . $value . '"';
            }
        }
        $ret .= '><thead><tr>';

        //create columns header
        foreach ($this->columns as $name => $column) {
            $ret .= '<th';

            $title = '';
            foreach ($column as $key => $value) {
                if ($key != self::COLUMN_PHP_FUNCTION &&
                    $key != self::COLUMN_PHP_FORMAT &&
                    $key != self::COLUMN_DATA_SEARCH_EXACT &&
                    $key != self::COLUMN_TITLE
                ) {
                    if (is_bool($value) === true) {
                        $ret .= ' ' . $key . '="' . ($value ? 'true' : 'false') . '"';
                    } else {
                        $ret .= ' ' . $key . '="' . $value . '"';
                    }

                } else if ($key == self::COLUMN_TITLE) {
                    $title = $value;
                }
            }
            $ret .= '>' . $title . '</th>';
        }
        $ret .= '</tr></thead></table>';

        return $ret;
    }

    private function fixSystemColumn()
    {
        //quick fix for created_at, updated_at, deleted_at columns
        foreach (['created_at', 'updated_at', 'deleted_at'] as $name) {
            if (array_key_exists($name, $this->columns)) {
                $this->setColumnAttr($name, self::COLUMN_PHP_FORMAT, self::COLUMN_FORMAT_DAY_DATE);
            }
        }
    }

    private function fixFormatColumn()
    {
        //format value
        foreach ($this->columns as $key => $value) {
            if ($this->getColumnAttr($key, self::COLUMN_PHP_FORMAT, self::COLUMN_FORMAT_NONE) != self::COLUMN_FORMAT_NONE &&
                $this->getColumnAttr($key, self::COLUMN_PHP_FUNCTION, null) == null
            ) {
                $function = function ($row, $indexOfPage, $index) use ($key) {
                    try {
                        //format value
                        switch ($this->getColumnAttr($key, self::COLUMN_PHP_FORMAT)) {
                            case self::COLUMN_FORMAT_DATE:
                                return $row[$key]->toDateString();

                            case self::COLUMN_FORMAT_TIME:
                                return $row[$key]->toTimeString();

                            case self::COLUMN_FORMAT_DATE_TIME:
                                return $row[$key]->toDateTimeString();

                            case self::COLUMN_FORMAT_CUSTOM:
                                return $row[$key]->format($this->custom);

                            case self::COLUMN_FORMAT_FORMATTED_DATE:
                                return $row[$key]->toFormattedDateString();

                            case self::COLUMN_FORMAT_DAY_DATE:
                                return $row[$key]->toDayDateTimeString();
                        }

                    } catch (Exception $ex) {
                        //if error show error in row
                        return $ex->getMessage();
                    }
                };

                $this->setColumnAttr($key, self::COLUMN_PHP_FUNCTION, $function);
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
                    if ($value[self::COLUMN_SEARCHABLE]) {
                        $exactWordSearch = $this->getExactWordSearch();
                        if (!$exactWordSearch) {
                            //check single columns
                            $exactWordSearch = $this->getColumnAttr($key, self::COLUMN_DATA_SEARCH_EXACT, false);
                        }

                        //where if not function
                        //if ($this->getColumnAttr($key, self::COLUMN_PHP_FUNCTION, null) == null) {
                        $query->orWhere($key, 'like', $exactWordSearch ? $search : '%' . $search . '%');
                        //}
                    }
                }
            });
        }

        //total record
        $count = $query->count();

        //limit and retrive record
        $offset = Input::get('offset', 0);
        $query->skip($offset);
        $query->take(Input::get('limit', 100));

        //sort
        $sort = Input::get('sort', '');
        if ($sort != '') {
            $query = $query->orderBy($sort, Input::get('order', 'asc'));
        }

        //get data
        $data = $query->get();

        //check if exists calcualted field
        $calculated = false;
        foreach ($this->columns as $key => $value) {
            if ($this->getColumnAttr($key, self::COLUMN_PHP_FUNCTION, null) != null) {
                $calculated = true;
                break;
            }
        }

        if ($calculated) {
            //parse data

            $index = 0;
            $data = $data->map(function ($row) use (&$index, $offset) {
                $entry = array();

                $index++;

                //transfer value in column row
                foreach ($this->columns as $key => $value) {
                    //check is calculated by function
                    $function = $this->getColumnAttr($key, self::COLUMN_PHP_FUNCTION, null);

                    if ($function == null) {
                        $entry[$key] = $row[$key];

                    } else {

                        //call function
                        try {
                            $entry[$key] = call_user_func($function, $row, $index, $index + $offset);
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
