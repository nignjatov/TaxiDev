<!-- Create Operator Modal Start -->
<div class="modal fade" id="createOperator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create LifePak</h4>
            </div>
            <form id="lifePakInfo" class="lifePakInfo form-horizontal" action="<?php echo site_url('LifePak/createLifePak')?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">
                            <span>Name </span>
                            <span class="error">*</span>
                        </label>
                        <div class="col-md-6">
                            <input id="lifePakName" name="lifePakName" class="form-control m-bot15" type="text" required data-bv-notempty-message="The LifePak name is required" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <textarea id="PakDescription" name="PakDescription" rows="6" class="form-control" type="text" maxlength="500"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Start Date & End Date</label>
                        <div class="col-md-6">
                            <div class="input-group input-large m-bot15">
                                <input type="text" class="form-control dateType" name="lifePakStartDate" id="lifePakStartDate">
                                <span class="input-group-addon">To</span>
                                <input type="text" class="form-control dateType" name="lifePakEndDate" id="lifePakEndDate">
                            </div>
                            <span class="help-block daterange_lifepak">Select date range</span>
                            <span>Dates are optional. Leave End date empty and pak will run indefinitely.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">LifePak Type</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label>
                                    <input checked="checked" type="radio" name="lifePakScope" id="radioPublic" onclick="selectLifePakType('Public')">Public</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="lifePakScope" id="radioSemiPrivate" onclick="selectLifePakType('Semi-Priv')">Semi Private</label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="lifePakScope" id="radioPrivate" onclick="selectLifePakType('Private')">Private</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-question-circle fa-2 object_hint popovers" data-trigger="hover" data-placement="top" data-content="Public paks are available to all mobile users. Semi-private requires an access code you give users. Private paks are only for users whose email address you enter." data-original-title="LifePak Type"></i>
                        </div>
                    </div>
                    <div class="form-group" id="enterCode" style="display: none"></div>
                    <div class="form-group" id="enterEmail" style="display: none"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Category <span class="error">*</span></label>
                        <div class="col-md-6">
                            <input id="lifePakID" name="lifePakID" type="hidden" value="">
                            <select multiple name="SubCategoryIDs" id="SubCategoryIDs" style="width:315px" class="populate" required>
                                <?php
                                foreach($categories AS $categoryTitle => $subCategories){
                                    echo '<optgroup label="'.$categoryTitle.'">';
                                    foreach($subCategories AS $subCategory){
                                        echo '<option value="'.$subCategory['SubCategoryID'].'">'.$subCategory['SubCategoryTitle'].'</option>';
                                    }
                                    echo '</optgroup>';
                                }
                                ?>
                            </select>
                            <input type="hidden" name="selectedSubcategories" id="selectedSubcategories" value="">
                        </div>
                        <div class="col-md-3">
                            <i class="fa fa-question-circle fa-2 object_hint popovers" data-trigger="hover" data-placement="top" data-content="Select up to 3 categories for your LifePak to be listed under in the RealLife Exp app" data-original-title="LifePak Category"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="create_lifepak" class="btn btn-info" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create Operator Modal End -->