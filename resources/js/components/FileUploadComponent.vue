<style scoped>
    div.form-group {
        margin-top: 10px;
    }
</style>

<template>
    <div class="form-group">
        <label for="picture">上传一张图片</label>
        <input type="file" class="form-control-file" id="picture" ref="picture" v-on:change="uploadFile"/>
        <input type="hidden" id="picture-path" name="picture" value="">
        <div id="picture-preview">

        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            uploadFile() {
                let formData = new FormData();
                formData.append('picture', this.$refs.picture.files[0]);
                axios.post(
                    '/form/file_upload',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function (response) {
                    $('#picture-path').val(response.data.path);
                    $('#picture-preview').html('<img src="' + response.data.path + '">')
                }).catch(function (error) {
                    if (error.response.status === 422) {
                        $.each(error.response.data.errors, function (field, errors) {
                            $('#picture-preview').append('<div class="alert alert-danger">' + errors[0] + '</div>');
                        });
                    }
                    console.log(error);
                });
            }
        }
    }
</script>