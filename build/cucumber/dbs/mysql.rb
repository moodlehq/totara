require 'mysql'

# setup config.php to use mysql db
load_config('mysql')

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
  result.fetch_hash['count']
end

# return a user's ID given their username
def get_username_id(username)
  learner = run_query("SELECT id FROM mdl_user WHERE username='#{username}'")
  learner.fetch_hash['id']
end

# return next available number from column
# use max so we can use on sequence free columns like sort order
def get_next_sequence table_name, field_name
  result = run_query("SELECT MAX(#{field_name})+1 AS count FROM #{table_name}")
  if result.fetch_hash['count'].nil? then
    1
  else
    result.fetch_hash['count']
  end
end
