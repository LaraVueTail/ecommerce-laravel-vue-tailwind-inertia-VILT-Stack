<template>
    <div class="bg-red-500 py-2 px-4 fixed bottom-6 right-6 rounded" v-if="hide">
        <p class="text-white text-md">{{ $page.props.flash.message }}</p>
    </div>
</template>
<script>
export default{
    data(){
        return {
            message : this.$page.props.flash.message,
            hide: true
        }
    },
    watch:{
       
        'this.$page.props.flash.message':{
            handler() {
                console.log('hi')}
            // this.hide = true
            // setTimeout(
            //     ()=>{this.hide = false},3000
            // )
        }
    }
}
</script>
