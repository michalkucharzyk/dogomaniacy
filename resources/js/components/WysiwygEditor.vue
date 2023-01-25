<template>
    <editor :initial-value="this.value" :init="config" :name="this.nameSelector" :api-key="this.API_KEY"/>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

const API_KEY = '7srna6igdxxgytomrfrylvcjmsy8lbcibbob4v62llesff14'
const config = {
    plugins: [
        "advlist autolink lists code table paste"
    ],
    toolbar:
        "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent|",
    height: 300
};
export default {
    data() {
        return {
            config,
            API_KEY
        };
    },

    props: ['nameSelector', 'value'],

    components: {
        'editor': Editor
    }
}
</script>