require 'pg'

# Methods to handle Postgres databases

# store a table's contents to a temp file
def save_table(table_name)
  run "pg_dump -Fc -O -t #{table_name} -U #{@@test_database_username} #{@@test_database_name} > /tmp/#{table_name}.pgdump"
end

# load a table's contents from a temp file
def load_table(table_name)
  run "pg_restore -O -c -d #{@@test_database_name} -U #{@@test_database_username} /tmp/#{table_name}.pgdump"
end

# run a query on the database
def run_query(query)
  db = PGconn.connect(@@test_database_location, 5432, '', '', @@test_database_name, @@test_database_username, @@test_database_password)
  db.exec(query)
end


# return count of records in table
def count_records table_name
  result = run_query("SELECT COUNT(*) AS count FROM #{table_name}")
  result.getvalue(0,0)
end

# return a single field from a table
def get_field table_name, field_name, element, value
  result = run_query("SELECT #{field_name} FROM #{table_name} WHERE #{element}='#{value}'")
  result.getvalue(0,0)
end

# return next available number from column
# use max instead of nextval() so we can use on sequence free
# columns like sortorder
def get_next_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name})+1 AS count FROM #{table_name}")
  if result.getvalue(0,0).nil? then
    1
  else
    result.getvalue(0,0)
  end
end

# get current sequence, can't use currval as sessions are terminated
# using max also like get_next_sequence
def get_current_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name}) AS count FROM #{table_name}")
  if result.getvalue(0,0).nil? then
    1
  else
    result.getvalue(0,0)
  end
end
