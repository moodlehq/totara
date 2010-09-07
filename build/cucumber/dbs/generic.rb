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
    number = Time.now.to_i
  end
  # strip mdl_ prefix from table_name
  meth = ('get_' + table_name[$prefix.length..-1] + '_record').to_sym
  begin
    send meth, number.to_i
  rescue
    raise "Could not find method #{meth.to_s}. " +
      "You need to create a method in cucumber/record_templates.rb."
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

