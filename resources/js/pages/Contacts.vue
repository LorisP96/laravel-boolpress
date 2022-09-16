<template>
    <section class="container">
        <h1>Contattaci</h1>
    <form>
        <div class="form-group">
            <label for="user-name">Nome</label>
            <input type="text" class="form-control" id="user-name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Scrivici qualcosa</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </section>
</template>

<script>
export default {
    name: 'Contacts'
}
</script>

<style>

</style>