# methods that return a record suitable for insert_record

def get_comp_framework_record number
  {
    'fullname' => 'Test Competency Framework '+number.to_s,
    'shortname' => 'Test Comp Framework '+number.to_s,
    'idnumber' => 'ID'+number.to_s,
    'description' => 'Description for Test Competency Framework '+number.to_s,
    'sortorder' => get_next_sequence($prefix+'comp_framework', 'sortorder'),
    'visible' => 1,
    'hidecustomfields' => 1,
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
    'defaultid' => 1,
  }
end

def get_comp_scale_values_record number
  {
    'name' => 'Competency Scale Value ' + number.to_s,
    'idnumber' => 'ID' + number.to_s,
    'description' => 'Description for Competency Scale Value ' + number.to_s,
    'scaleid' => get_next_sequence($prefix+'comp_scale','id').to_i - 1,
    'numericscore' => number.to_s,
    'sortorder' => get_next_sequence($prefix+'comp_scale_values', 'sortorder'),
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
    'proficient' => 0,
  }
end

def get_comp_depth_record number
  {
    'fullname' => 'Test Competency Depth '+number.to_s,
    'shortname' => 'Test Comp Depth '+number.to_s,
    'description' => 'Description for Test Competency Depth '+number.to_s,
    'depthlevel' => 1,
    'frameworkid' => get_current_sequence($prefix+'comp_framework', 'id'),
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_org_framework_record number
  {
    'fullname' => 'Test Organisation Framework '+number.to_s,
    'shortname' => 'Test Org Framework '+number.to_s,
    'idnumber' => 'ID'+number.to_s,
    'description' => 'Description for Test Organisation Framework '+number.to_s,
    'sortorder' => get_next_sequence($prefix+'org_framework', 'sortorder'),
    'visible' => 1,
    'hidecustomfields' => 1,
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_org_framework_record number
  {
    'fullname' => 'Test Organisation Framework '+number.to_s,
    'shortname' => 'Test Org Framework '+number.to_s,
    'idnumber' => 'ID'+number.to_s,
    'description' => 'Description for Test Organisation Framework '+number.to_s,
    'sortorder' => get_next_sequence($prefix+'org_framework', 'sortorder'),
    'visible' => 1,
    'hidecustomfields' => 1,
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_org_depth_record number
  {
    'fullname' => 'Test Organisation Depth '+number.to_s,
    'shortname' => 'Test Org Depth '+number.to_s,
    'description' => 'Description for Test Organisation Depth '+number.to_s,
    'depthlevel' => 1,
    'frameworkid' => get_current_sequence($prefix+'org_framework', 'id'),
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_pos_framework_record number
  {
    'fullname' => 'Test Position Framework '+number.to_s,
    'shortname' => 'Test Pos Framework '+number.to_s,
    'idnumber' => 'ID'+number.to_s,
    'description' => 'Description for Test Position Framework '+number.to_s,
    'sortorder' => get_next_sequence($prefix+'pos_framework', 'sortorder'),
    'visible' => 1,
    'hidecustomfields' => 1,
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end

def get_pos_depth_record number
  {
    'fullname' => 'Test Position Depth '+number.to_s,
    'shortname' => 'Test Pos Depth '+number.to_s,
    'description' => 'Description for Test Position Depth '+number.to_s,
    'depthlevel' => 1,
    'frameworkid' => get_current_sequence($prefix+'pos_framework', 'id'),
    'timecreated' => Time.now.to_i,
    'timemodified' => Time.now.to_i,
    'usermodified' => 0,
  }
end
