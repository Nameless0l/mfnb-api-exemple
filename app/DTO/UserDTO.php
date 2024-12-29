<?php

namespace App\DTO;

use App\Http\Requests\UserRequest;
readonly class UserDTO
{

    public function __construct(
        public? string $name,
        public? string $email,
        public? \DateTimeInterface $email_verified_at,
        public? int $is_admin,
        public? int $is_stylist,
        public? string $password,
        public? \DateTimeInterface $updated_at,
        public? string $remember_token,
    ) {}

    public static function fromRequest(UserRequest $request): self
    {
        return new self(
            name: $request->get('name'),
            email: $request->get('email'),
            email_verified_at: \Carbon\Carbon::parse($request->get('email_verified_at')),
            is_admin: $request->get('is_admin'),
            is_stylist: $request->get('is_stylist'),
            password: $request->get('password'),
            updated_at: \Carbon\Carbon::parse($request->get('updated_at')),
            remember_token: $request->get('remember_token'),
        );
    }
}
