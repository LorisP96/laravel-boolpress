<template>
    <section class="container">
        <h1>Contattaci</h1>

        <div v-if="success" class="alert alert-success _myalert" role="alert">Grazie per averci contattato</div>

        <form @submit.prevent="sendMessage()">
            <div class="form-group">
                <label for="user-name">Nome</label>
                <input v-model="userName" type="text" class="form-control mb-2" id="user-name">
                <div v-if="errors.name" class="alert alert-danger" role="alert">{{errors.name}}</div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input v-model="userEmail" type="email" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div v-if="errors.email" class="alert alert-danger" role="alert">{{errors.email}}</div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Scrivici qualcosa</label>
                <textarea v-model="userText" class="form-control mb-2" id="exampleFormControlTextarea1" rows="3"></textarea>
                <div v-if="errors.text" class="alert alert-danger" role="alert">{{errors.text}}</div>
            </div>
            
            <button type="submit" class="btn btn-primary" :disabled="sending">Submit</button>
        </form>
    </section>
</template>

<script>

export default {
    name: 'Contacts',
    data() {
        return {
            userName: '',
            userEmail: '',
            userText: '',
            success: false,
            errors: {},
            sending: false,
        }
    },
    methods: {
        sendMessage() {
            this.sending = true;
            axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                text: this.userText,
            })
            .then((response) => {
                if(response.data.success) {
                    this.success = true;
                    this.userName = '';
                    this.userEmail = '';
                    this.userText = '';
                } else {
                    this.errors = response.data.errors;
                }

                this.sending = false;
            });
        }
    }
}
</script>

<style lang="scss" scoped>
.container {
    ._myalert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}
</style>
