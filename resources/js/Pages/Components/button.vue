<template>
    <button 
        :class="[
            'px-3 sm:px-5 py-2 text-base rounded-md transition-colors flex items-center gap-2',
            disabled ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 text-white cursor-pointer'
        ]"
        @click="handleClick"
    >
        <!-- Show only icon on small screens if icon prop is provided -->
        <span v-if="icon" class="block sm:hidden">
            <i :class="icon"></i>
        </span>
        <!-- Show text on larger screens -->
        <span class="hidden sm:block">
            <slot></slot>
        </span>
        <!-- Show both icon and text on larger screens if icon exists -->
        <i v-if="icon" class="hidden sm:block" :class="icon"></i>
    </button>
</template>

<script>
export default {
    name: 'CustomButton',
    props: {
        type: {
            type: String,
            default: 'button'
        },
        disabled: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: ''
        }
    },
    computed: {
        buttonClass() {
            return {
                'btn': true,
                'btn-disabled': this.disabled
            };
        }
    },
    methods: {
        handleClick(event) {
            if (!this.disabled) {
                this.$emit('click', event);
            }
        }
    }
};
</script>