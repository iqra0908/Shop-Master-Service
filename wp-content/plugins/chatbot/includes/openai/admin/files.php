<?php 
global $wpchatbot_pro_professional_init,$wpchatbot_pro_master_init;
if((isset($wpchatbot_pro_master_init) && $wpchatbot_pro_master_init->is_valid()) || (isset($wpchatbot_pro_professional_init) && $wpchatbot_pro_professional_init->is_valid()) || (function_exists('get_openaiaddon_valid_license') && get_openaiaddon_valid_license())){
?>
<div class="row">
    <div  class="col-md-12">
    <div class="alert alert-danger my-4">
                <?php esc_html_e('Fine tuning will not work yet if you select ChatGPT as engine. We will add this feature as soon as OpenAI supports it'); ?>
            </div>
        <form class="file_form">
            <div class="success-message alert alert-info"></div>
            <div class="error-message alert alert-danger"></div>
            <input type="file" (change)="fileEvent($event)" class="inputfile" id="openfileinput" style="display:none"/>
            <label for="openfileinput" class="huge ui grey button">
                <i class="fa fa-upload"></i> 
                <?php esc_html_e( 'Upload JSONL','wpbot'); ?>
            </label>
        </form>
        </br>
        <a href="https://wpbot.pro/myfile.jsonl" download><?php esc_html_e( 'Right click and Save the Example jsonl file','wpbot');?></a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead><tr><td> <?php esc_html_e( 'File name','wpbot'); ?></td><td><?php esc_html_e( 'File id','wpbot');?></td><td><?php esc_html_e( 'Action','wpbot');?></td></tr></thead>
                <tbody id="openaiFileList">
                    
                </tbody>
            </table>
        </div>
        <div class="my-5">
            <h2><?php esc_html_e( 'Fine Tuned Models List','wpbot');?></br></h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead><tr><td><?php esc_html_e( 'FT id','wpbot');?></td><td><?php esc_html_e( 'FT Model','wpbot');?></td><td><?php esc_html_e( 'Status','wpbot');?> </td><td><?php esc_html_e( 'File Name','wpbot');?></td><td> <?php esc_html_e( 'File Id','wpbot');?></td></tr></thead>
                <tbody id="openaiFTList">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
 } else { ?>
<div class="row">
    <div  class="col-md-12">
        <?php
                esc_html_e('Fine tuning and training is available with the WPBot Pro Professional and Master Licenses');

        ?>
    </div>
</div>
<?php } ?>

    <div id="qcld-ft-modal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php esc_html_e( 'Create your Fine Tune','wpbot'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="qcld_openai_suffix" class="form-label"><?php esc_html_e( 'Suffix for custom model','wpbot');?></label>
                        <input id="qcld_openai_ft_suffix" class="form-control" type="text" name="qcld_openai_ft_suffix" value="<?php echo esc_attr(get_option( 'qcld_openai_suffix')); ?>">
                        <input id="qcld_openai_ft_fileid" class="form-control" type="hidden" name="qcld_openai_ft_fileid" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1"><?php esc_html_e( 'Fine tune model','wpbot'); ?></label>
                        <select class="form-select" aria-label="Default select example" name="qcld_openai_ft_engines" id="qcld_openai_ft_engines">
                            <option <?php echo ((get_option( 'openai_engines') == '') ? 'selected' : '') ; ?>><?php esc_html_e( 'Please select Engines','wpbot');?></option>
                            <option value="text-davinci-003" <?php echo esc_html((get_option( 'openai_engines') == 'text-davinci-003') ? 'selected' : '') ; ?>><?php esc_html_e( 'Davinci (GPT-3 model)','wpbot');?></option>
                            <option value="text-davinci-001" <?php echo esc_html((get_option( 'openai_engines') == 'text-davinci-001') ? 'selected' : '') ; ?>><?php esc_html_e( 'Davinci','wpbot');?></option>
                            <option value="text-ada-001" <?php echo esc_html((get_option( 'openai_engines') == 'text-ada-001') ? 'selected' : '') ; ?>><?php esc_html_e( 'Ada','wpbot');?></option>
                            <option value="text-curie-001" <?php echo esc_html((get_option( 'openai_engines') == 'text-curie-001') ? 'selected' : '') ; ?>><?php esc_html_e( 'Curie','wpbot');?></option>
                            <option value="text-babbage-001" <?php echo esc_html((get_option( 'openai_engines') == 'text-babbage-001') ? 'selected' : '' ); ?>><?php esc_html_e( 'Babbag','wpbot');?></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e( 'Close','wpbot'); ?></button>
                        <button type="button" class="btn btn-primary create_ft_model"><?php esc_html_e( 'Create Fine tune','wpbot'); ?></button>
                </div>
            </div>
         </div>
    </div>

