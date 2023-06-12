<?php

namespace App\Repositories;

use App\Exceptions\ApiOperationFailedException;
use App\Models\User;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name', 'email',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * @param  array  $input
     * @return User
     */
    public function store($input)
    {
        /** @var AccountRepository $accountRepo */
        $accountRepo = App::make(AccountRepository::class);

        try {
            /** @var User $user */
            $user = User::create($input);
            $this->updateProfilePhoto($user, $input);

            $activateCode = $accountRepo->generateUserActivationToken($user->id);
            if (! $user->is_active) {
                $accountRepo->sendConfirmEmail($user->name, $user->email, $activateCode);
            }

            return $user;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return User
     */
    public function update($input, $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        try {
            $user->update($input);
            $this->updateProfilePhoto($user, $input);

            return $user;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @return bool|void
     *
     * @throws ApiOperationFailedException
     */
    public function updateProfile($input)
    {
        /** @var User $user */
        $user = Auth::user();
        if (empty($user)) {
            throw new BadRequestHttpException('User not found.');
        }

        $this->updateProfilePhoto($user, $input);

        return true;
    }

    public function updateProfilePhoto(User $user, $avatar)
    {

        $options = ['height' => User::HEIGHT, 'width' => User::WIDTH];
        if (! empty($avatar)) {
            // $file['avatar'] = ImageTrait::makeImage($avatar, User::$PATH, $options);
            $fileName = ImageTrait::makeImage($avatar, User::$PATH, $options);
            $oldImageName = $user->avatar;
            if (! empty($oldImageName)) {
                unlink(public_path('uploadedfiles/'. $oldImageName));
                // $user->deleteImage();
            }
        }
        return $fileName;
       // $file = $user->update($file);
    }
}
