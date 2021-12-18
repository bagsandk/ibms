function getAction(id) {
  return `<div class="dropdown custom-dropdown">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i data-feather="more-horizontal"></i>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item detailButton" data-id="${id.trim()}" href="javascript:void(0);">Detail</a>
                    <a class="dropdown-item editButton"  data-id="${id.trim()}" href="javascript:void(0);">Edit</a>
                    <a class="dropdown-item"  data-id="${id.trim()}" href="javascript:void(0);">Delete</a>
                  </div>
                </div>`;
}