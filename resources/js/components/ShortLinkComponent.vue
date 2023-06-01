<template>
    <div class="d-flex-center flex-column">
        <div class="col-md-6 mx-auto">

            <button
                class="btn btn-generate-size d-block mx-auto"
                :class="isInputEmpty ? 'btn-outline-warning' : 'btn-warning'"
                @click="generateLink"
            >
                Generate link
            </button>

            <input
                type="text"
                class="form-control w-25 mt-4 mx-auto"
                ref="inputUrl"
                v-model="inputUrl"
            >

            <input
                v-if="outputUrl.length !== 0"
                type="text"
                disabled
                class="form-control w-25 mt-4 mx-auto"
                ref="outputUrl"
                v-model="outputUrl"
            >
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            inputUrl: '',
            outputUrl: '',
            isInputEmpty: true,
        }
    },
    methods: {
        generateLink() {
            if (this.isInputEmpty) {
                return setTimeout(this.focusInput, 50);
            }

            axios.put('', {inputUrl: this.inputUrl})
                .then(response => {
                    console.log(response);
                    this.outputUrl = '12';
                    this.isInputEmpty = true;

                })
                .catch(error => {
                    console.log(error);
                })
        },
        focusInput() {
            this.$refs.inputUrl.focus();
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    watch: {
        inputUrl: function (newVal) {
            this.isInputEmpty = newVal.length === 0;

            this.outputUrl = '';
        }
    }
}
</script>
