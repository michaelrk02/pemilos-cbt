<div>
    <div class="w3-content" style="padding: 160px 0; max-width: 500px">
        <div class="w3-card w3-teal">
            <div class="w3-padding">
                <h3>Masuk</h3>
            </div>
            <div class="w3-white">
                <div class="w3-padding">
                    <?php if (isset($status)) { status_message($status); } ?>
                </div>
                <?php echo form_open('exam/login'); ?>
                    <div>
                        <div class="w3-padding-large">
                            <input type="text" name="username" class="w3-input" placeholder="Masukkan username">
                            <input type="password" name="password" class="w3-input" placeholder="Masukkan password">
                        </div>
                    </div>
                    <div>
                        <div class="w3-padding-large">
                            <input type="submit" class="w3-btn w3-green" value="Masuk">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
