module NavigationHelpers
  # map names to database tables
  def tables
    {
      'competency framework' => 'comp_framework',
      'competency' => 'comp',
      'competency scale' => 'comp_scale',
      'competency scale value' => 'comp_scale_values',
      'competency type' => 'comp_type',
      'organisation framework' => 'org_framework',
      'organisation type' => 'org_type',
      'position framework' => 'pos_framework',
      'position type' => 'pos_type',
      'organisation' => 'org',
    }
  end

  # map names to CSS selectors
  def selectors
    {
      'edit competency frameworks table'       => 'table.editcompetency',
      'edit position frameworks table'         => 'table.editposition',
      'edit organisation frameworks table'     => 'table.editorganisation',
      'edit organisation table'                => 'table.editorganisation',
      'edit organisation depth table'          => 'table.editorganisation',
      'organisation table'                     => 'table.hierarchy-index',
      'custom category table'                  => 'table.editorganisation',
      'scale value table'                      => 'table.generaltable',
      'position table'                         => 'table.editposition',
      'organisation column'                    => 'td#middle-column',
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
      'a learners my records' => '/local/plan/record/courses.php?userid=' + get_username_id('learner').to_s,
      'an administrators my records' => '/local/plan/record/courses.php?userid=' + get_username_id('admin').to_s,
      'manage competencies' => '/hierarchy/framework/index.php?prefix=competency',
      'manage organisations' => '/hierarchy/framework/index.php?prefix=organisation',
      'manage positions' => '/hierarchy/framework/index.php?prefix=position',
      'add competency framework' => '/hierarchy/framework/edit.php?prefix=competency',
      'add position framework' => '/hierarchy/framework/edit.php?prefix=position',
      'add organisation framework' => '/hierarchy/framework/edit.php?prefix=organisation',
      'manage position types' => '/hierarchy/type/index.php?prefix=position',
      'manage competency types' => '/hierarchy/type/index.php?prefix=competency',
      'manage organisation types' => '/hierarchy/type/index.php?prefix=organisation',

      # URL to delete a specified position depth
      'edit position depth' => '/hierarchy/depth/edit.php'
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

