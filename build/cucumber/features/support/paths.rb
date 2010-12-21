module NavigationHelpers
  # map names to database tables
  def tables
    {
      'competency framework' => 'comp_framework',
      'competency' => 'comp',
      'competency scale' => 'comp_scale',
      'competency scale value' => 'comp_scale_values',
      'organisation framework' => 'org_framework',
      'organisation depth' => 'org_depth',
    }
  end

  # map names to CSS selectors
  def selectors
    {
      'edit competency frameworks table'       => 'table.editcompetency',
      'edit position frameworks table'         => 'table.editposition',
      'edit organisation frameworks table'     => 'table.editorganisation',
      'edit organisation table'                => 'table.editorganisation',
    }
  end

  # map names to URLs
  def paths
    {
      'a'            => '/',
      'home'         => '/',
      'admin'        => '/admin/index.php',
      'login'        => '/login/index.php',
      'my records'   => '/local/plan/record/courses.php',
      'a learners my records' => '/local/plan/record/courses.php?userid=' + get_username_id('learner'),
      'an administrators my records' => '/local/plan/record/courses.php?userid=' + get_username_id('admin'),
      'manage competency frameworks' => '/hierarchy/framework/index.php?type=competency',
      'manage organisation frameworks' => '/hierarchy/framework/index.php?type=organisation',
      'manage position frameworks' => '/hierarchy/framework/index.php?type=position',
      'add competency framework' => '/hierarchy/framework/edit.php?type=competency',
      'add position framework' => '/hierarchy/framework/edit.php?type=position',
      'add organisation framework' => '/hierarchy/framework/edit.php?type=organisation',
      'manage competencies' => '/hierarchy/index.php?type=competency',
      'manage positions' => '/hierarchy/index.php?type=position',
      'manage organisations' => '/hierarchy/index.php?type=organisation',
    }
  end


  # helper methods for name mappings

  def get_table name, inc_prefix=true
    prefix = inc_prefix ? @@prefix : ''
    tables.each do |key, table|
      return prefix + table if key == name
    end
    raise "Can't find mapping from \"#{name}\" to a table\n" +
      "Now, go and add a mapping in #{__FILE__}"
  end


  def get_selector name
    selectors.each do |key, selector|
      return selector if key == name
    end
    raise "Can't find mapping from \"#{name}\" to a CSS selector.\n" +
      "Now, go and add a mapping in #{__FILE__}"
  end


  def get_path name
    paths.each do |key, path|
      return @@site_url + path if key == name
    end
    raise "Can't find mapping from \"#{name}\" to a path.\n" +
      "Now, go and add a mapping in #{__FILE__}"
  end


  def get_site_url
    @@site_url
  end
end

World(NavigationHelpers)

