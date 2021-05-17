<!-- Modal for Add Class Service -->
            <div class="modal fade" id="addService" role="dialog">
                <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Class Service</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form action="" method="post">
                        <input class="input-edit" type="text" name="title" placeholder="Title" required/><br>
                            <select class="select-gender-edit" name="type">
                                <option value="#" disabled selected>Type</option>
                                <option value="regular">Regular</option>
                                <option value="pilates">Pilates</option>
                                <option value="cardio">Cardio</option>
                                <option value="bodybuild">Body Building</option>
                                <option value="yoga">Yoga</option>
                            </select>
                            <input class="input-edit" type="number" min="0.01" step="0.01" name="price" placeholder="Price" required/><br>
                            <input class="input-edit" type="number" name="max" placeholder="Max Capacity" required/><br>
                            <input class="input-edit" type="number" name="month" placeholder="Duration Month" required/><br>
                            <input class="input-edit" type="number" name="year" placeholder="Duration Year (**optional)"/><br>
                            <input placeholder="Date Started" class="textbox-n input-edit" type="text" onfocus="(this.type='date')" name="date_start" id="date"><br>
                            <input class="input-edit" type="text" name="schedule" placeholder="Schedule Date" required/><br>
                            <textarea class="input-edit" name="description" cols="50" rows="8" placeholder="Description"></textarea>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="submit" value="add">Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                </div>
                
            </div>