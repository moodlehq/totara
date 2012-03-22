<?php
// customfields.php - created with Totara langimport script version 1.1

$string['category'] = '类别';
$string['categorynamemustbeunique'] = '类别名（必须唯一）';
$string['categorynamenotunique'] = '该类别名已经使用';
$string['commonsettings'] = '公共设置';
$string['confirmcategorydeletion'] = '类别中 {$a} 字段将被移入类别上面或下面。<br />您是否希望删除该类别吗？';
$string['confirmfielddeletion'] = '此字段的 {$a} 条记录将被删除。<br />您是否仍希望删除该字段？';
$string['coursecustomfields'] = '课程自定义字段';
$string['createcustomfieldcategory'] = '创建自定义字段类别';
$string['createnewcategory'] = '创建一个新的类别';
$string['createnewcustomfield'] = '新建自定义字段';
$string['createnewfield'] = '新建&quot;{$a}&quot;自定义字段';
$string['customfield'] = '自定义字段';
$string['customfieldcategories'] = '自定义字段类别';
$string['customfields'] = '自定义字段';
$string['customfieldtypecheckbox'] = '选择框';
$string['customfieldtypefile'] = '文件';
$string['customfieldtypemenu'] = '选择菜单';
$string['customfieldtypetext'] = '文本输入框';
$string['customfieldtypetextarea'] = '文本域';
$string['defaultchecked'] = '默认选中';
$string['defaultdata'] = '默认值';
$string['deletecategory'] = '删除一个类别';
$string['deletefield'] = '删除一个字段';
$string['description'] = '字段描述';
$string['editcategory'] = '编辑自定义字段类别：{$a}';
$string['editfield'] = '编辑自定义字段：{$a}';
$string['fieldcolumns'] = '列';
$string['fieldispassword'] = '这是密码字段吗？';
$string['fieldmaxlength'] = '字段长';
$string['fieldrows'] = '行';
$string['fieldsize'] = '显示大小';
$string['forceunique'] = '数据是唯一吗？';
$string['locked'] = '该字段是否锁定？';
$string['menudefaultnotinoptions'] = '默认值不在选项中';
$string['menunooptions'] = '无菜单选择';
$string['menuoptions'] = '菜单选项（每行一个）';
$string['menutoofewoptions'] = '您必须提供至少两个选项';
$string['nocustomfieldcategories'] = '要添加自定义字段，请首先创建自定义字段类别';
$string['nocustomfieldcategoriesdefined'] = '未定义任何自定义字段类别';
$string['nocustomfieldsdefined'] = '无定义字段';
$string['customfieldrequired'] = '该字段是否必填？';
$string['shortname'] = '简称（必须唯一）';
$string['shortnamenotunique'] = '简称已经使用';
$string['specificsettings'] = '具体设置';
$string['visible'] = '在设置页上隐藏？';
$string['customfieldhidden_help'] = '﻿
# 在设置页面上隐藏？

设置为“是”时，在设置页面上或在应当显示的其他地方，自定义字段将不可见。设置为“否”时，自定义字段将可见。';
$string['customfieldfullname_help'] = '﻿
# 自定义字段全称

自定义字段全称是自定义字段的完整标题。';
$string['customfieldforceunique_help'] = '﻿
# 数据应唯一吗？

设置为“是”时，自定义字段将仅接受一个唯一的值。如果在此字段中使用重复值，系统将不允许保存项。

设置为“否”时，自定义字段将接受字段中的任何值。';
$string['customfieldlocked_help'] = '﻿
# 该字段是否锁定？

设置为“是”时，自定义字段将仅显示设置字段时设置的信息。无法编辑该字段。';
$string['customfieldmenuoptions_help'] = '﻿
# 菜单选项（选项菜单）

输入将出现在下拉框中的菜单选项。

每行只能输入一个选项。';
$string['customfieldshortname_help'] = '﻿
# 自定义字段简称

自定义字段简称是自定义字段的简短名称，且可以用于显示。

自定义字段在编辑项屏幕上以选项形式出现，与指派自定义字段时同一深度级别的项对应。';
$string['customfieldrowstextarea_help'] = '﻿
# 行（文本区域）

设置可用的文本区域的高度（行数）。';
$string['customfieldrequired_help'] = '﻿
# 该字段是否为必填？

该字段是否为必填？如果设置为“是”，则在此深度级别创建新项时，它将是一个必填字段。

如果设置为“否”，则在此深度级别创建新项时，它将是一个可选字段。';
$string['customfieldfieldsizetext_help'] = '﻿
# 显示大小（文本输入）

显示大小用于设置将在“文本”字段中显示的字符数。';
$string['customfieldmaxlengthtext_help'] = '﻿
# 最大长度（文本输入）

最大长度用于设置文本字段将接受的最大字符数。';
$string['customfielddefaultdatatext_help'] = '﻿
# 默认值（文本输入）

默认值是在默认情况下将出现在文本字段中的文本。

如果没有所需的默认文本，则将此字段留空。';
$string['customfieldcategory_help'] = '﻿
# 类别

创建**类别**后即可在某个页面上（例如在能力、位置或组织页面上）将其他自定义字段组合在一起。';
$string['customfieldcategories_help'] = '﻿
# 自定义字段类别

**自定义字段类别**允许设置自定义类别以在深度级别下面保存自定义字段。

设置“自定义”字段类别和“自定义”字段以允许捕获层次结构项的所有相关信息，并允许其在“添加/编辑层次结构项”页面上显示。

自定义字段类别名称必须是深度级别独有的。要设置自定义字段，您至少需要设置一个自定义字段类别。

**添加自定义类别：**单击**创建自定义字段类别**，添加新的自定义字段类别。

**编辑/删除自定义类别：**单击**打开编辑**以编辑或删除现有自定义字段类别。';
$string['customfielddefaultdatatextarea_help'] = '﻿
# 默认值（文本区域）

默认值是在默认情况下将出现在文本区域中的文本。

如果没有所需的默认文本，则将此字段留空。';
$string['customfieldcategoryname_help'] = '﻿
# 自定义字段类别名称

**自定义字段类别**名称有助于将所需的自定义字段类型组合在一起，并且必须是您所在的深度级别所独有的。 

键入名称，并单击**保存更改**。';
$string['customfieldcolumnstextarea_help'] = '﻿
# 列（文本区域）

**列**用于设置可用的文本区域的宽度。';
$string['customfielddefaultdatamenu_help'] = '﻿
# 默认值（选项菜单）

设置将出现在下拉框中的默认值。默认值必须出现在上面的菜单选项中。

如果没有所需的默认条目，则留空。';
$string['customfielddefaultdatacheckbox_help'] = '﻿
# 默认选中（复选框）

设置为“是”时，“自定义”字段复选框将默认选中。

设置为“否”时，“自定义”字段复选框将默认为不选中。';

