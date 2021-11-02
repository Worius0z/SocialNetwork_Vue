<template>
    
    <button type="submit" class=" items-center inline-flex justify-center px-4
    py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white
    uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue700 focus:shadow-outline-blue
    active:bg-blue-600 transition ease-in-out duration-150">
        <slot></slot>
    </button>
            
</template>

<script>
    import {defineComponent} from 'vue'
    export default defineComponent({
        components: { 
        },
        props: {
            type:{
                type: String,
                default: 'button',
            }
        }
        
    })
</script>