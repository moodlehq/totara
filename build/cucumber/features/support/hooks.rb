# create hooks for tables in features/support/paths.rb
tables.each do |desc, table|
  # save the table, leaving the contents
  # then restore after
  Before ('@store_' + table[@@prefix.length..-1]) do
    save_table(table)
  end
  After ('@store_' + table[@@prefix.length..-1]) do
    load_table(table)
  end

  # save the table, then empty it
  # then restore original after
  Before ('@empty_' + table[@@prefix.length..-1]) do
    empty_table(table)
  end
  After ('@empty_' + table[@@prefix.length..-1]) do
    load_table(table)
  end

end

