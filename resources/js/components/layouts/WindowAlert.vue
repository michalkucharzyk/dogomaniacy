<template></template>

<script>
export default {
    props: ['type', 'oneMessage', 'arrayMessage'],
    mounted() {
        if (this.type === 'success') {
            this.$swal({
                title: 'Wspaniale!',
                text: this.oneMessage,
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        }
        if (this.type === 'error') {
            let messages = null
            JSON.parse(this.arrayMessage).forEach((value, index) => {
                value = '<span class="text-danger">' + value + '</span>'
                if (messages === null) {
                    messages = value;
                } else {
                    messages = messages + '<br />' + value
                }
            });
            this.$swal({
                title: 'Coś poszło nie tak!',
                html: messages,
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        }
    }
}
</script>
