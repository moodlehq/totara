<?php

/*
 * Class defining a report builder filter option
 */
class rb_filter_option {
    public $type, $value, $label, $filtertype, $selectfunc;
    public $selectchoices, $selectoptions, $defaultadvanced;

    function __construct($type, $value, $label, $filtertype,
        $options=array()) {

        // use defaults if options not set
        $defaults = array(
            'selectfunc' => null,
            'selectchoices' => array(),
            'selectoptions' => null,
            'defaultadvanced' => 0,
        );
        $options = array_merge($defaults, $options);

        $this->type = $type;
        $this->value = $value;
        $this->label = $label;
        $this->filtertype = $filtertype;

        // assign optional properties
        foreach($defaults as $property => $unused) {
            $this->$property = $options[$property];
        }

    }

    /*
     * Returns an attribute variable used to limit the width of a pulldown
     *
     * This code is required to fix limited width pulldowns in IE. The
     * if(document.all) condition limits the javascript to only affect IE.
     *
     * @return array Array of the correct format to be used by a 'select'
     *               form element
     */
    static function select_width_limiter() {
        return array(
            'class' => 'mitms-limited-width',
            'onMouseDown'=>"if(document.all) this.className='mitms-expanded-width';",
            'onBlur'=>"if(document.all) this.className='mitms-limited-width';",
            'onChange'=>"if(document.all) this.className='mitms-limited-width';"
        );
    }

} // end of rb_filter class

