# none db-specific functions

# delete all records from table
def delete_all_records table_name
  run_query("DELETE FROM #{table_name}")
end

def add_record table_name, number=nil
  record = get_record_object table_name, number
  insert_record table_name, record
end

def get_record_object table_name, number=nil

  # use timestamp if not specified
  if number.nil? then
    number = get_next_sequence(table_name, 'id')
  end
  # strip mdl_ prefix from table_name
  meth = ('get_' + table_name[$prefix.length..-1] + '_record').to_sym
  begin
    send meth, number.to_i
  rescue StandardError => fail
    puts 'Method call failed with error: ' + fail
    raise "It may be that you need to create the method #{meth.to_s} " +
      " in cucumber/features/support/record_templates.rb."
  end
end

def insert_record table, hash, debug=false
  cols = hash.keys.join(',')
  values = "'" + hash.values.join("','") + "'"
  query = "INSERT INTO #{table} (#{cols}) VALUES (#{values})"
  puts query if debug
  run_query query
end

# store a table's contents then empty it
def empty_table table_name
  save_table table_name
  delete_all_records table_name
end

# return a user's ID given their username
def get_username_id(username)
  get_field $prefix+'user', 'id', 'username', username
end

# return a scale's ID given its name
def get_scale_id(scalename)
  get_field $prefix+'comp_scale', 'id', 'name', scalename
end


