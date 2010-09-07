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

