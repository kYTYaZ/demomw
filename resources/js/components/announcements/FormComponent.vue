
<template>
    <div class="container">
      
	<div class="row">
		<div class="col col-xl-8 order-xl-2 col-lg-8 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Personal Information</h6>
				</div>
				<div class="ui-block-content">

					
					<!-- Personal Information Form  -->
					
					<form>
						<div class="row">
					
							<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
								<div class="form-group label-floating">
									<label class="control-label">First Name</label>
									<input class="form-control" placeholder="" type="text" value="James">
								</div>
					
							</div>
					
						</div>
					</form>
					
					<!-- ... end Personal Information Form  -->
				</div>
			</div>
		</div>

		<div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 order-md-2 col-sm-12  responsive-display-none">
			<div class="ui-block">

				
				
				<!-- Your Profile  -->
				
				<div class="your-profile">
					<div class="ui-block-title ui-block-title-small">
						<h6 class="title">Subir Imágen</h6>
					</div>
                                        <div class="ui-block-content">

                                         <file-pond
                                            name="image"
                                            ref="pond"
                                            allowImagePreview="true"
                                            allowImageCrop="true"
                                            allowImageTransform="true"
                                            label-idle="Ingresar imágen de la convocatoria"
                                            allow-multiple="false"
                                            accepted-file-types="image/jpeg, image/png"
                                            server="/upload"
                                            v-bind:files="images"
                                            v-on:init="handleFilePondInit"/>
                                        </div>	  
				</div>
				
				<!-- ... end Your Profile  -->
				

			</div>
		</div>
	</div>

    </div>
</template>

<script>
    
    // Import Vue FilePond
import vueFilePond from 'vue-filepond';

// Import FilePond styles
import 'filepond/dist/filepond.min.css';

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';

// Create component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview, FilePondPluginImageCrop,FilePondPluginImageTransform);

export default {
    name: 'app',
    data: function() {
        return { images: ['/img/avatar9-sm.jpg'] };
    },
    methods: {
        handleFilePondInit: function() {
            console.log('FilePond has initialized');
        }
    },
    components: {
        FilePond
    }
};
</script>
