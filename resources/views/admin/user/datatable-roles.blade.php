@can(PrivilegeAdmin::WEB_ROLE_READ)
    @foreach ($roles as $role)
        <a href="{{ route('admin.roles.show',['role' => $role]) }}"
            class="button gray"
        >{{ $role->name }}</a>
    @endforeach
@else
    @foreach ($roles as $role)
        {{ $role->name }}
    @endforeach
@endcan
