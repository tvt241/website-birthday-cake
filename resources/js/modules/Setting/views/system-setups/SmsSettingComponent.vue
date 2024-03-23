<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>API Key</label>
                <input type="text" placeholder="" class="form-control" name="apiKey" value="" required
                    autocomplete="off">
            </div>

            <div class="form-group">
                <label>Auth Domain</label>
                <input type="text" class="form-control" name="authDomain" value="" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Project ID</label>
                <input type="text" class="form-control" name="projectId" value="" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Storage Bucket</label>
                <input type="text" class="form-control" name="storageBucket" value="" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>Messaging Sender ID</label>
                <input type="text" placeholder="" class="form-control" name="messagingSenderId" value="" required
                    autocomplete="off">
            </div>

            <div class="form-group">
                <label>App ID</label>
                <input type="text" placeholder="" class="form-control" name="appId" value="" required
                    autocomplete="off">
            </div>

            <div class="btn--container">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" onclick="" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</template>