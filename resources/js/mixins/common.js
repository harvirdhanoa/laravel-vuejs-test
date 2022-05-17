export default {
    methods: {
        toastMessage: function (message, type) {
            // this.$toast.clear();
            this.$toast.open({
                message: message,
                type: (type) ? type : 'success',
                duration: 5000,
                position: 'top-right'
            });
        },
        errorMessage(error) {
            let message = "Something went wrong try again later.";
            if (
                error.response &&
                error.response.data &&
                error.response.data.message
            ) {
                message = error.response.data.message;
            } else if (
                error.response &&
                error.response.data &&
                error.response.data.errors
            ) {
                message = error.response.data.errors.toString().split(",").join("\n");
            } else if (error.message) {
                message = error.message;
                if (message === "Network Error") {
                    message = "Kindly check your internet connection.";
                }
            }

            return message;
        }
    },
}