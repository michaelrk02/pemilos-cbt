<div>
    <div style="padding-top: 192px; padding-bottom: 192px">
        <div class="w3-content w3-card w3-teal" style="max-width: 500px">
            <div class="w3-padding">
                <h3>Masuk</h3>
            </div>
            <div class="w3-padding w3-white">
                <div class="w3-padding">
                    <?php if (isset($status)) { status_message($status); } ?>
                </div>
                <?php echo form_open('admin/auth'); ?>
                    <div class="w3-padding">
                        <label for="password">Password:</label>
                        <input id="password" name="password" class="w3-input" type="password" placeholder="Masukkan password">
                    </div>
                    <div class="w3-padding">
                        <input type="submit" value="Masuk" class="w3-btn w3-green">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
