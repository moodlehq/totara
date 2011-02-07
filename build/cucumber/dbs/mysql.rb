require 'mysql'

# MySQL specific functions

# store a table's contents to a temp file
def save_table table_name
  run "mysqldump -u #{@@test_database_username} " +
    "--password=#{@@test_database_password} " +
    "#{@@test_database_name} #{table_name} " +
    "> /tmp/#{table_name}"
end

# load a table's contents from a temp file
def load_table table_name
  run "mysql -u #{@@test_database_username} " +
    "--password=#{@@test_database_password} " +
    "#{@@test_database_name} " +
    "< /tmp/#{table_name}"
end

# store a table's contents then empty it
def empty_table table_name
  save_table table_name
  delete_all_records table_name
end

# run a query on the database
def run_query(query)
  db = Mysql.new @@test_database_location,
    @@test_database_username,
    @@test_database_password,
    @@test_database_name
  db.query query
end

# return count of records in table
def count_records table_name
  result = run_query("SELECT COUNT(*) AS count FROM #{table_name}")
  if result.nil? then
    0
  else
    result.fetch_hash['count']
  end
end

# return a single field from a table
def get_field table_name, field_name, element, value
  result = run_query("SELECT #{field_name} AS field FROM #{table_name} WHERE #{element}='#{value}'")
  if result.nil? then
    nil
  else
    result.fetch_hash['field']
  end
end

# return next available number from column
# use max so we can use on sequence free columns like sort order
def get_next_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name})+1 AS count FROM #{table_name}")
  if result.nil? then
    1
  else
    result.fetch_hash['count']
  end
end

# get current sequence, can't use currval as sessions are terminated
# using max also like get_next_sequence
def get_current_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name}) AS count FROM #{table_name}")
  if result.nil? then
    1
  else
    result.fetch_hash['count']
  end
end
