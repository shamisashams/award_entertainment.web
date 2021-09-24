<?php
/**
 *  app/Traits/ScopeFilter.php
 *
 * Date-Time: 19.05.21
 * Time: 10:59
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Traits;



use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopeFilter
 * @package App\Traits
 */
trait ScopeBlogFilter
{

    /**
     * @param  $request
     * @return Builder
     */
    public function filter($request): Builder
    {
        $data = $this->query();
        $filterScopes = $this->getFilterScopes();
        foreach ($this->getActiveFilters($request) as $filter => $value) {
            if (!array_key_exists($filter, $filterScopes)) {
                continue;
            }
            $filterScopeData = $filterScopes[$filter];

            if (false === $filterScopeData['hasParam']) {
                $data->{$value}();
                continue;
            }
            $methodToExecute = $filterScopeData['scopeMethod'];
            $data->{$methodToExecute}($value);
        }

        $sortParams = ['sort' => 'id', 'order' => 'desc'];

        if ($request->filled('sort') && $request->filled('order')) {
            $sortParams = $request->only('sort', 'order');
        }

        return $data->sorted($sortParams);
    }

    public function getActiveFilters($request): array
    {
        $activeFilters = [];
        foreach ($this->getFilterScopes() as $key => $value) {
            if ($request->filled($key)) {
                $activeFilters [$key] = $request->{$key};
            }
        }
        return $activeFilters;
    }





    public function scopeSorted($query, array $sortParams)
    {
        return $query->orderBy($sortParams['sort'], $sortParams['order']);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    /**
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * @param $query
     * @param $title
     * @return mixed
     */
    public function scopeTitle($query, $title)
    {
        return $query->whereHas('languages', function ($query) use ($title) {
            return $query->where('title', 'like', '%' . $title . '%');
        });
    }

    public function scopeDescription($query, $description)
    {
        return $query->whereHas("languages", function ($query) use ($description) {
            return $query->where('description', 'like', '%' . $description . '%');
        });
    }

    public function scopeShortdescription($query, $short_description)
    {
        return $query->whereHas("languages", function ($query) use ($short_description) {
            return $query->where('short_description', 'like', '%' . $short_description . '%');
        });
    }
    public function scopeContent($query, $content)
    {
        return $query->whereHas("languages", function ($query) use ($content) {
            return $query->where('content', 'like', '%' . $content . '%');
        });
    }

    /**
     * @param $query
     * @param $abbreviation
     * @return mixed
     */

    public function scopeSlug($query, $slug)
    {
        return $query->whereHas("languages", function ($query) use ($slug) {
            return $query->where('slug', 'like', '%' . $slug . '%');
        });
    }

    public function scopeCity($query, $city)
    {
        return $query->whereHas("languages", function ($query) use ($city) {
            return $query->where('city', 'like', '%' . $city . '%');
        });
    }
    public function scopeCountry($query, $country)
    {
        return $query->whereHas("languages", function ($query) use ($country) {
            return $query->where('country', 'like', '%' . $country . '%');
        });
    }
    /**
     * @param $query
     * @param $native
     * @return mixed
     */
    public function scopeNative($query, $native)
    {
        return $query->where('native', 'like', '%' . $native . '%');
    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeEmail($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $address
     *
     * @return mixed
     */
    public function scopeAddress($query, $address)
    {
        return $query->where('address', $address);
    }


    /**
     * @param $query
     * @param $default
     *
     * @return mixed
     */
    public function scopeDefault($query, $default)
    {
        return $query->where('default', $default);
    }

    /**
     * @param $query
     * @param $locale
     *
     * @return mixed
     */
    public function scopeLocale($query, $locale)
    {
        return $query->where('locale', $locale);
    }

    /**
     * @param $query
     * @param $key
     *
     * @return mixed
     */
    public function scopeKey($query, $key)
    {
        return $query->where('key', 'like', '%' . $key . '%');
    }

    /**
     * @param $query
     * @param $group
     *
     * @return mixed
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', 'like', '%' . $group . '%');
    }

    /**
     * @param $query
     * @param $text
     *
     * @return mixed
     */
    public function scopeText($query, $text)
    {
        return $query->where('group',$text);
    }


    /**
     * @param $query
     * @param $verify
     *
     * @return mixed
     */
    public function scopeVerify($query, $verify)
    {
        return $query->where('verify', $verify);
    }


}
