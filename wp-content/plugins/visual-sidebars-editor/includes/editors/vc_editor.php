<div class="wrap <?php if ($this->vc_active) echo "vc_wrap" ?>">
    <h1 class="section_title">Edit Sidebar</h1>

    <form id="post" name="post" method="post" action="">
        <!-- hidden fields -->
        <?php wp_nonce_field('epx_vcsb_save') ?>
        <input type="hidden" name="sidebar_id" value="<?php echo $current_sidebar['id'] ?>">
        <input type="hidden" name="save" value="<?php echo self::post_type ?>">
        <input type='hidden' id='post_ID' name='post_ID' value='<?php echo $post_ID ?>'>

        <div id="poststuff" style="display:none;">
            <div class="bt_row">
                <!-- Sidebar editor -->
                <div class="bt_col-sm-8 bt_col-lg-9">
                    <div class="postbox">
                        <div class="postbox_header bt_clearfix">
                            <h3><?php echo ucwords($current_sidebar['name']) ?></h3>

                            <?php if (count($wp_registered_sidebars) > 1): ?>
                                <div class="postbox_tools">
                                    <div class="buttons bootstrap">
                                        <div class="btn-group">
                                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="xico xico-menu"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <?php
                                                $csid = $current_sidebar['id'];
                                                foreach ($wp_registered_sidebars as $sidebar_id => $sidebar):
                                                    if ($sidebar_id === $csid) continue;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $this->admin_url ?>&sidebar=<?php echo $sidebar_id ?>">
                                                            <?php echo ucwords($sidebar['name']) ?>
                                                        </a>
                                                    </li>
                                                <?php
                                                endforeach
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="inside">

                            <!-- Sidebar title -->
                            <div id="titlediv" class="section">
                                <input type="text" name="post_title" placeholder="Sidebar title" class="widefat" value="<?php echo $post_title ?>" autocomplete="off">
                            </div>

                            <!-- Hidden editor, used for dependency purposes -->
                            <div style="display: none !important">
                                <div style="display: none !important">
                                    <?php
                                    wp_editor('', 'nothing_to_do_with_it', array(
                                        'quicktags' => false,
                                        'media_buttons' => false,
                                        'textarea_rows' => 1,
                                        'teeny' => true
                                    ))
                                    ?>
                                </div>
                            </div>

                            <!-- Classic wordpress editor -->
                            <div id="postdivrich" style="display: block">
                                <?php
                                wp_editor($post_content, 'content', array(
                                    'dfw' => true,
                                    'drag_drop_upload' => true,
                                    'tabfocus_elements' => 'insert-media-button,save-post',
                                    'editor_height' => 300,
                                    'tinymce' => array(
                                        'resize' => false,
                                        'wp_autoresize_on' => true,
                                        'add_unload_trigger' => false,
                                    ),
                                ));
                                ?>
                            </div>

                            <!-- Visual composer editor -->
                            <div id="wpb_visual_composer" style="display: none">
                                <?php
                                if ($this->vc_active) {
                                    add_filter('wpb_vc_js_status_filter', create_function('', "return 'true';"));
                                    $vc_manager->backendEditor()->renderEditor($post);
                                }
                                ?>
                            </div>

                            <div class="section bt_clearfix">
                                <!-- Submit button -->
                                <div class="bt_pull-right">
                                    <button type="submit" id="publish" name="action" value="save" class="xbtn xbtn-primary">Save Changes
                                    </button>
                                </div>

                                <!-- Delete button -->
                                <div class="xbtn-group bt_pull-left bt_clearfix">
                                    <?php if ($post_content): ?>
                                        <button type="button" data-target="#sidebar_content_exporter" class="xbtn mce_window" title="Export Content">Export
                                        </button>
                                    <?php endif ?>
                                    <button type="button" data-target="#sidebar_content_importer" class="xbtn mce_window" title="Import Content">Import
                                    </button>
                                    <?php
                                    if ($current_sidebar['revisions']) {
                                        $link = get_edit_post_link($current_sidebar['revision_id']);
                                        $count = $current_sidebar['revisions_count'];
                                        printf('<a href="%s" class="xbtn">History (%d)</a>', $link, $count);
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="bt_col-sm-4 bt_col-lg-3">
                    <div class="postbox" id="sidebar_ssettings">
                        <div class="postbox_header bt_clearfix">
                            <h3>Sidebar Settings</h3>
                        </div>

                        <div class="inside">
                            <div class="epx_vcsb_field">
                                <div class="epx_vcsb_field_label">
                                    <label>Sidebar Status</label>
                                </div>
                                <div class="epx_vcsb_field_control">
                                    <?php
                                    $this->html_radios(
                                        'post_status',
                                        array(
                                            'publish' => "Public",
                                            'private' => 'Private'
                                        ),
                                        $post_status
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="epx_vcsb_field">
                                <div class="epx_vcsb_field_label">
                                    <label>Override behavior</label>
                                </div>
                                <div class="epx_vcsb_field_control bt_clearfix">
                                    <?php
                                    if (!$settings->behavior) {
                                        $settings->behavior = apply_filters('vcse_default_behavior', 'replace', $current_sidebar);
                                    }
                                    $this->html_radios(
                                        'settings[behavior]',
                                        array(
                                            'replace' => "Replace all sidebar widgets",
                                            'before' => "Place before existing widgets",
                                            'after' => "Place after existing widgets",
                                            'position' => "Place in the following position",
                                        ),
                                        $settings->behavior
                                    )
                                    ?>
                                    <input type="text" id="settings_behavior_value" name="settings[behavior_value]" class="bt_pullleft hidden" value="<?php echo $settings->behavior_value ?>" placeholder="Custom position"/>
                                </div>
                            </div>
                            <div class="epx_vcsb_field">
                                <div class="epx_vcsb_field_label">
                                    <label>Widget wrapper</label>
                                </div>
                                <div class="epx_vcsb_field_control">
                                    <?php
                                    $this->html_radios(
                                        'settings[container]',
                                        array(
                                            'default' => "Use theme wrapper",
                                            'none' => "No wrapper",
                                        ),
                                        $settings->container
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="epx_vcsb_field">
                                <div class="epx_vcsb_field_label">
                                    <label>Override Global Post</label>
                                </div>
                                <div class="epx_vcsb_field_control">
                                    <?php
                                    $this->html_radios(
                                        'settings[global]',
                                        array(
                                            'yes' => "Yes",
                                            'no' => "No",
                                        ),
                                        $settings->global
                                    )
                                    ?>
                                </div>
                            </div>
                            <?php if ($post_ID): ?>
                                <div class="epx_vcsb_field">
                                    <div class="epx_vcsb_field_label">
                                        <label>Delete sidebar content and settings</label>
                                    </div>
                                    <div class="epx_vcsb_field_control">
                                        <button type="submit" id="delete" name="action" value="delete" class="xbtn xbtn-danger">Delete
                                        </button>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        var selectAllText = function (elem) {
            elem.select();
            elem.onmouseup = function () {
                elem.onmouseup = null;
                return false;
            };
        };
    </script>

    <?php if ($post_content): ?>
        <div id="sidebar_content_exporter" class="hidden" style="width:600px;height:350px" data-cancel="Close">
            <div style="height:100%">
                <textarea class="imexport" onfocus="selectAllText(this)" readonly><?php echo $post_content ?></textarea>
            </div>
        </div>
    <?php endif ?>

    <div id="sidebar_content_importer" class="hidden" style="width:600px;height:350px" data-cancel="Close" data-submit="Import">
        <form style="height:100%" method="post" action="">
            <textarea name="content" class="imexport" placeholder="Paste content here" required></textarea>

            <label id="import_override"> <input name="override" type="checkbox" checked/> Override Existing Content?
            </label>

            <!-- hidden fields -->
            <?php wp_nonce_field('epx_vcsb_save') ?>
            <input type="hidden" name="sidebar_id" value="<?php echo $current_sidebar['id'] ?>">
            <input type="hidden" name="save" value="<?php echo self::post_type ?>">
            <input type="hidden" name="action" value="import"> <input type="submit" class="hidden"/>
        </form>
    </div>

    <script type="text/javascript">
        !function ($) {
            $("input[name='settings[behavior]']").on('change', function () {
                $input = $("#settings_behavior_value");
                if (this.checked && this.value == 'position') {
                    $input.removeClass('hidden');
                } else {
                    $input.addClass('hidden');
                }
            }).trigger('change');

            $('.mce_window').on('click', function (e) {
                e.preventDefault();

                var target = $($(this).data('target'));
                var title = $(this).attr('title');
                var buttons = [];

                if (!target.length) return;

                var win = null;

                if (label = target.data('cancel')) {
                    buttons.push({
                        text: label,
                        onclick: function () {
                            win.close();
                        }
                    });
                }

                if (label = target.data('submit')) {
                    buttons.push({
                        text: label,
                        subtype: 'primary',
                        style: 'width:100px',
                        onclick: function () {
                            $('#' + win._id).find('form').submit();
                        }
                    });
                }

                win = tinymce.activeEditor.windowManager.open({
                    html: target.html(),
                    title: title,
                    width: target.outerWidth(),
                    height: target.outerHeight(),
                    buttons: buttons
                });

            });

            $("#delete").on('click', function () {
                $this = $(this);
                tinymce.activeEditor.windowManager.confirm("You are about to permanently delete the sidebar content and settings!", function (yes) {
                    if (yes) {
                        $this.off('click').click();
                    }
                });
                return false;
            });

            $(window).load(function () {
                $("#poststuff").fadeIn(400);
                $('.dropdown-toggle').dropdown();
            });

            function __return_true() {
                return true;
            }

            function __return_false() {
                return false;
            }
        }(jQuery);
    </script>
</div>
