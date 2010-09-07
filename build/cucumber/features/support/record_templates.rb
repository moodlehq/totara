# methods that return a record suitable for insert_record

def get_comp_framework_record number
  {
    'fullname' => 'Test Competency Framework '+number.to_s,
    'shortname' => 'Test Comp Framework '+number.to_s,
    'idnumber' => 'ID'+number.to_s,
    'description' => 'Description for Test Competency Framework '+number.to_s,
    'sortorder' => get_next_sequence('mdl_comp_framework', 'sortorder'),
    'visible' => 1,
    'hidecustomfields' => 1,
    'showitemfullname' => 1,
    'showdepthfullname' => 1,
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_comp_scale_record number
  {
    'name' => 'Competency Scale ' + number.to_s,
    'description' => 'Description for Competency Scale ' + number.to_s,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
    'proficient' => 1,
    'defaultid' => 1,
  }
end

def get_comp_scale_values_record number
  {
    'name' => 'Competency Scale Value ' + number.to_s,
    'idnumber' => 'ID' + number.to_s,
    'description' => 'Description for Competency Scale Value ' + number.to_s,
    'scaleid' => get_next_sequence('mdl_comp_scale','id').to_i - 1,
    'numericscore' => number.to_s,
    'sortorder' => get_next_sequence('mdl_comp_scale_values', 'sortorder'),
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

