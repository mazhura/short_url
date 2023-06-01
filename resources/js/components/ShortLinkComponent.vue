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

            <div class="text-bg-danger w-25 mt-4 mx-auto text-center">{{ errorMessage }}</div>

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
            inputUrl: 'http://',
            outputUrl: '',
            isInputEmpty: true,
            errorMessage: '',
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
                    this.outputUrl = response.data.outputUrl;
                    this.isInputEmpty = true;
                })
                .catch(error => {
                    this.errorMessage = error.response.data.error;

                    setTimeout(() => {
                        this.errorMessage = ''
                    }, 4000)
                })
        },
        focusInput() {
            this.$refs.inputUrl.focus();
        }
    },
    watch: {
        inputUrl: function (newVal, oldVal) {
            if (newVal[newVal.length - 1] === ' ') {
                this.inputUrl = oldVal;
            }

            let baseUrlLength = 'http://'.length;

            this.isInputEmpty = newVal.length === baseUrlLength;

            this.outputUrl = '';

            if (newVal.length < baseUrlLength) {
                this.inputUrl = 'http://';
            }
        }
    }
}
</script>
