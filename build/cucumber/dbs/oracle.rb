require 'rubygems'
require 'oci8'
require 'dbi'

# Oracle specific functions

# store a table's contents to a temp file
def save_table table_name
# TODO not working yet
#  run "mysqldump -u #{@@test_database_username} " +
#    "--password=#{@@test_database_password} " +
#    "#{@@test_database_name} #{table_name} " +
#    "> /tmp/#{table_name}"
end

# load a table's contents from a temp file
def load_table table_name
# TODO not working yet
#  run "mysql -u #{@@test_database_username} " +
#    "--password=#{@@test_database_password} " +
#    "#{@@test_database_name} " +
#    "< /tmp/#{table_name}"
end

# store a table's contents then empty it
def empty_table table_name
  save_table table_name
  delete_all_records table_name
end

# run a query on the database
def run_query(query)
  # ODBC must be configured. See:
  # https://docs.totaralms.com/index.php/Test_Management/Oracle
  db = DBI.connect('DBI:OCI8:(DESCRIPTION=(ADDRESS=(PROTOCOL=tcp)(HOST=brumbies.wgtn.cat-it.co.nz)(PORT=1522))(CONNECT_DATA=(SERVICE_NAME = MOODLE)))', 'hudson', 'moodle')
  result = db.select_all query
  db.disconnect
  result
end

# return count of records in table
def count_records table_name
  result = run_query("SELECT COUNT(*) AS count FROM #{table_name}")
  if result[0][0].nil? then
    0
  else
    result[0][0].to_i
  end
end

# return a single field from a table
def get_field table_name, field_name, element, value
  result = run_query("SELECT #{field_name} AS field FROM #{table_name} WHERE #{element}='#{value}'")
  if result[0][0].nil? then
    nil
  else
    result[0][0].to_i
  end
end

# return next available number from column
# use max so we can use on sequence free columns like sort order
def get_next_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name})+1 AS count FROM #{table_name}")
  if result[0][0].nil? then
    1
  else
    result[0][0].to_i
  end
end

# get current sequence, can't use currval as sessions are terminated
# using max also like get_next_sequence
def get_current_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name}) AS count FROM #{table_name}")
  if result[0][0].nil? then
    1
  else
    result[0][0].to_i
  end
end
