<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li><i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'dashboard']) ?>">Home</a>
        </li>
        <li class="active">Contact Us Request List</li>
    </ul>
</div>
<div class="page-content">
    <div class="page-header">
        <h1>Contact Us Request List
            <form style="float:right" method="post" action="">
                <?php $csrfToken = $this->request->getAttribute('csrfToken'); if ($csrfToken): ?>
                <input type="hidden" name="_csrfToken" value="<?= h($csrfToken) ?>">
                <?php endif; ?>
                <input type="text" placeholder="Search by Unique Id" name="search" value="<?= h($search_uniqueid ?? '') ?>">
                <input type="submit" name="submit" class="btn btn-mini btn-primary" value="Search">
                <a class="btn btn-mini btn-warning" href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Quicks', 'action' => 'requestList', 'clear']) ?>">Clear All</a>
            </form>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unique ID</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($QuoteRequest && $QuoteRequest->count() > 0): ?>
                            <?php foreach ($QuoteRequest as $item): ?>
                            <tr>
                                <td><?= h($item->fullname) ?></td>
                                <td><?= h($item->uniqueid) ?></td>
                                <td><?= h($item->email) ?></td>
                                <td><?= h($item->phone) ?></td>
                                <td><?= h($item->address) ?></td>
                                <td><?= h($item->note) ?></td>
                                <td><?= $item->created ? $item->created->format('d M Y') : '' ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">No requests found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (isset($this->Paginator) && method_exists($this->Paginator, 'numbers')): ?>
            <div class="paginator"><?= $this->Paginator->prev() ?> <?= $this->Paginator->numbers() ?> <?= $this->Paginator->next() ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
