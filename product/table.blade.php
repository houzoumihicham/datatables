<div class="row">
    <div class="col-md-12">
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-comments"></i>List </div>
                <div class="tools">

                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">List des @lang($compact['title'].'.names')</span>
                        </div>
                        <div class="actions">
                            <a class="btn green " href="{{ route('backend.'.$compact['title'].'.create') }}">Ajouter</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span> </span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">Select...</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Cancel">Hold</option>
                                    <option value="Cancel">On Hold</option>
                                    <option value="Close">Close</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit">
                                    <i class="fa fa-check"></i> Submit</button>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable dataTable no-footer" id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th class="hidden-xs" width="2%"></th>
                                    <th width="10%"> Image</th>
                                    <th width="10%"> Titre </th>
                                    <th width="5%"> Actions </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td class="hidden-xs"> </td>
                                    <td> </td>
                                    <td> <input type="text" class="form-control form-filter input-sm" name="rs">  </td>
                                    <td>
                                        <div class="margin-bottom-5">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 no-padding">
                                                <button class="btn btn-sm green-meadow filter-submit margin-bottom">
                                                    <i class="fa fa-search"></i> Rechercher</button>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 no-padding">
                                                <button class="btn btn-sm red filter-cancel">
                                                    <i class="fa fa-times"></i> Réinitialiser</button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>

                        <div class="new-client">
                            <a class="btn btn-primary" href="{{ route('backend.'.$compact['title'].'.create') }}"><i class="fa fa-plus"></i> Nouveau @lang($compact['title'].'.name')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>